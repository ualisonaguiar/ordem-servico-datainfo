<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license. For more information, see
 * <http://www.doctrine-project.org>.
 */

namespace InepZend\Doctrine\Service;

use Doctrine\Common\Cache\CacheProvider;
use RuntimeException;
use Doctrine\Common\Cache\MemcacheCache;
use Doctrine\Common\Cache\MemcachedCache;
use Doctrine\Common\Cache\RedisCache;
use DoctrineModule\Service\CacheFactory as CacheFactoryDoctrine;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Cache ServiceManager factory
 *
 * @license MIT
 * @link    http://www.doctrine-project.org/
 * @author  Kyle Spraggs <theman@spiffyjr.me>
 */
class CacheFactory extends CacheFactoryDoctrine
{
    
    const FORCE_MEMCACHE = true;
    const CLEAR_MEMCACHE = false;
    
    /**
     * {@inheritDoc}
     *
     * @return \Doctrine\Common\Cache\Cache
     *
     * @throws RuntimeException
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var $options \DoctrineModule\Options\Cache */
        $options = $this->getOptions($serviceLocator, 'cache');
        $class   = $options->getClass();
        
        if (!$class) {
            throw new RuntimeException('Cache must have a class name to instantiate');
        }
        
        if (self::FORCE_MEMCACHE) {
            $arrCache = $serviceLocator->get('Config')['doctrine']['cache'];
            if ('filesystem' === $this->name) {
                $cache = new $class($options->getDirectory());
            } elseif ('array' === $this->name || 'memcache' === $this->name) {
                $memcacheService = $serviceLocator->get('InepZend\Cache\Service\Memcache');
                if (self::CLEAR_MEMCACHE)
                    $memcacheService->clearCache();
                if ($memcacheService->hasActiveMemcache()) {
                    $cache = new $arrCache['memcache']['class'];
                    $options->setInstance($memcacheService->getMemcache());
                } else {
                    $cache = new $arrCache['array']['class'];
                    $options->setInstance(null);
                }
            } else {
                $cache = new $class;
            }
        } else {
            if ('filesystem' === $this->name) {
                $cache = new $class($options->getDirectory());
            } else {
                $cache = new $class;
            }
        }
        
        $instance = $options->getInstance();
        
        if (is_string($instance) && $serviceLocator->has($instance)) {
            $instance = $serviceLocator->get($instance);
        }

        if ($cache instanceof MemcacheCache) {
            /* @var $cache MemcacheCache */
            $cache->setMemcache($instance);
        } elseif ($cache instanceof MemcachedCache) {
            /* @var $cache MemcachedCache */
            $cache->setMemcached($instance);
        } elseif ($cache instanceof RedisCache) {
            /* @var $cache RedisCache */
            $cache->setRedis($instance);
        }

        ;

        if ($cache instanceof CacheProvider && ($namespace = $options->getNamespace())) {
            $cache->setNamespace($namespace);
        }

        return $cache;
    }

}
