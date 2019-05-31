<?php
namespace InepZend\WebSocket;

/**
 * Trait responsavel em prover servico de socket.
 *
 *
 * @package InepZend
 * @subpackage WebSocket
 */
trait WebSocketServerTrait
{

    private $strHost = null;

    private $strPort = null;

    public $null = null;

    private $socket;

    /**
     * Metodo responsavel em iniciar o processo do WebSocket
     */
    public function starProcessSocket()
    {
        if ($this->strHost == null)
            $this->setHost('desenvphp.local');
        if ($this->strPort == null)
            $this->setPort('8083');
        
        $this->createSocket();
        $this->reuseablePort();
        $this->bindSocketHost();
        $this->listnerSocket();
        $this->listSocketLoop();
    }

    /**
     * Metodo responsavel Cria socket sream TCP / IP utilizando um endpoint para comunicacao
     *
     * AF_INET = IPv4 baseado nos protocolos de Internet. TCP e UDP sao protocolos comuns dessa familia de protocolos
     *
     * SOCK_STREAM = Fornece sequencial, seguro, e em ambos os sentidos,
     * conexoes baseadas em "byte streams". Dados "out-of-band" do mecanismo de transmissao devem ser suportados.
     * O protocolo TCP eh baseado neste tipo de socket
     *
     * SOL_TCP = Se o protocolo desejado he TCP, ou UDP as constantes correspondentes eh SOL_TCP
     */
    public function createSocket()
    {
        $this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    }

    /**
     * Metodo responsavel em reutilizar a porta para todos os sockets
     *
     * @return boolean
     */
    public function reuseablePort()
    {
        socket_set_option($this->socket, SOL_SOCKET, SO_REUSEADDR, 1);
    }

    /**
     * Metodo responsavel em realizar a vincular os sockets ao host
     *
     * @return boolean
     */
    public function bindSocketHost()
    {
        socket_bind($this->socket, 0, $this->getPort());
    }

    /**
     * Metodo responsavel em listar/escutar o socket
     *
     * @return multitype:resource
     */
    public function listnerSocket()
    {
        socket_listen($this->socket);
    }

    /**
     * Metodo responsavel em adicionar os sockets a um array
     *
     * @return multitype:resource
     */
    public function clientSocket()
    {
        $arrClients = array(
            $this->socket
        );
        
        return $arrClients;
    }

    /**
     * Metodo responsavel pela transacao entre a regra e a tela do(s) usuario(s)
     */
    public function listSocketLoop()
    {
        $arrClients = $this->clientSocket();
        $null = null;
        while (true) {
            $arrChanged = $arrClients;
            $intNumChangedSockets = socket_select($arrChanged, $null, $null, 0, 10);
            if ($intNumChangedSockets > 0) {
                // verificar se há novo socket
                if (in_array($this->socket, $arrChanged)) {
                    $this->getConnectionSocket($this->socket, $arrClients);
                    // Prepara dados json
                    $arrResponse = $this->setMask(json_encode(array(
                        'type' => 'system',
                        'message' => ''
                    )));
                    // Notificar todos os usuários sobre nova conexão
                    $this->sendMessage($arrResponse, $arrClients);
                    // Abrir espaço para o novo socket
                    $socketFound = array_search($this->socket, $arrChanged);
                    unset($arrChanged[$socketFound]);
                }
            }
            $this->getRoleService($arrClients);
        }
    }

    /**
     * Metodo exemplo de implementacao
     */
    public function getRoleTestImplements($arrChanged, $arrClients)
    {
        // Faz um loop através de todos os sockets conectados
        foreach ($arrChanged as $socketChanged) {
            // Verificar se existem dados incomming
            while (socket_recv($socketChanged, $buffer, 1024, 0) >= 1) {
                // envia dados
                $this->sendMessage($this->getRoler($buffer), $arrClients);
                // cria esse loop
                break 2;
            }
            $buffer = @socket_read($socketChanged, 1024, PHP_NORMAL_READ);
            $this->cleanBuffer($buffer, $socketChanged, $arrClients);
        }
    }

    /**
     * Metodo responsavel em limpar o buf removendos os usuarios desconectados
     *
     * @param buffer $buffer            
     * @param socket $socketChanged            
     * @param array $arrClients            
     */
    public function cleanBuffer($buffer, $socketChanged, $arrClients)
    {
        if ($buffer === false) {
            // verificar cliente desconectado
            // Remover cliente para array clientes
            $socketFound = array_search($socketChanged, $arrClients);
            socket_getpeername($socketChanged, $ip);
            unset($arrClients[$socketFound]);
            // Notificar todos os usuários sobre a conexão desconectado
            $arrResponse = $his->setMask(json_encode(array(
                'type' => 'system',
                'message' => ''
            )));
            $this->sendMessage($arrResponse);
        }
    }

    /**
     * Metodo contendo a regra responsavel pelo envio da mensagem, sendo necessario
     * reescrever para cada regra
     *
     * @param unknown $buffer            
     * @return string
     */
    public function getRoler($buffer)
    {
        $strReceived = $this->removMask($buffer); // Desmascarar dados
        $strMessage = json_decode($strReceived); // json decode
        $strUserName = $strMessage->name; // nome do remetente
        $strUserMessage = $strMessage->message; // Texto da mensagem
        $strUserColor = $strMessage->color; // cor
        // Prepara os dados a serem enviados para o cliente
        $strResponse = $this->setMask(json_encode(array(
            'type' => 'usermsg',
            'name' => $strUserName,
            'message' => $strUserMessage,
            'color' => $strUserColor
        )));
        return $strResponse;
    }

    /**
     * Metodo responsavel em retornar os sockets conectados
     *
     * @param socket $socket            
     * @param array $arrClients            
     */
    public function getConnectionSocket($socket, &$arrClients)
    {
        // aceita novo socket
        $socketNew = socket_accept($this->socket);
        // adicionar socket para o array cliente
        $arrClients[] = $socketNew;
        // ler dados enviados pelo socket
        $header = socket_read($socketNew, 1024);
        // executar websocket handshake
        $this->performHandshaking($header, $socketNew, $this->getHost(), $this->getPort());
        // Obtém o endereço IP do socket conectado
        socket_getpeername($socketNew, $ip);
    }

    /**
     * Metodo responsavel pelo envio das mensagens para o front-end
     *
     * @param string $strMessage            
     * @param array $arrClients            
     * @return boolean
     */
    public function sendMessage($strMessage, $arrClients)
    {
        foreach ($arrClients as $socketChanged) {
            socket_write($socketChanged, $strMessage, strlen($strMessage));
        }
        return true;
    }

    /**
     * Metodo responsavel em remover as mascaras com encode das mensagens a serem enviadas para o front-end
     *
     * @param string $strText            
     * @return Ambigous <string, boolean>
     */
    public function removMask($strText)
    {
        $intLength = ord($strText[1]) & 127;
        if ($intLength == 126) {
            $strMasks = substr($strText, 4, 4);
            $strData = substr($strText, 8);
        } elseif ($intLength == 127) {
            $strMasks = substr($strText, 10, 4);
            $strData = substr($strText, 14);
        } else {
            $strMasks = substr($strText, 2, 4);
            $strData = substr($strText, 6);
        }
        $strText = "";
        for ($i = 0; $i < strlen($strData); ++ $i) {
            $strText .= $strData[$i] ^ $strMasks[$i % 4];
        }
        return $strText;
    }

    /**
     * Metodo responsavel em mascarar com encode a mensagem a ser enviada para o front-end
     *
     * @param string $strText            
     * @return string
     */
    public function setMask($strText)
    {
        // Encode mensage para a transferência para o cliente.
        $strBase = 0x80 | (0x1 & 0x0f);
        $intLength = strlen($strText);
        
        if ($intLength <= 125)
            $header = pack('CC', $strBase, $intLength);
        elseif ($intLength > 125 && $intLength < 65536)
            $header = pack('CCn', $strBase, 126, $intLength);
        elseif ($intLength >= 65536)
            $header = pack('CCNN', $strBase, 127, $intLength);
        return $header . $strText;
    }

    /**
     * Metodo responsavel em adicionar novos clientes do servico
     *
     * @param unknown $receved_header            
     * @param unknown $client_conn            
     * @param unknown $host            
     * @param unknown $port            
     */
    public function performHandshaking($receved_header, $client_conn, $host, $port)
    {
        $headers = array();
        $lines = preg_split("/\r\n/", $receved_header);
        foreach ($lines as $line) {
            $line = chop($line);
            if (preg_match('/\A(\S+): (.*)\z/', $line, $matches)) {
                $headers[$matches[1]] = $matches[2];
            }
        }
        
        $secKey = $headers['Sec-WebSocket-Key'];
        $secAccept = base64_encode(pack('H*', sha1($secKey . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')));
        $upgrade = "HTTP/1.1 101 Web Socket Protocol Handshake\r\n" . "Upgrade: websocket\r\n" . "Connection: Upgrade\r\n" . "WebSocket-Origin: $host\r\n" . "WebSocket-Location: ws://$host:$port/demo/shout.php\r\n" . "Sec-WebSocket-Accept:$secAccept\r\n\r\n";
        
        socket_write($client_conn, $upgrade, strlen($upgrade));
    }

    /**
     * Metodo responsavel em setar o host a ser utilizado pelo servico
     *
     * @param string $strHost            
     * @return \InepZend\WebSocket\WebSocketServer
     */
    public function setHost($strHost)
    {
        $this->strHost = $strHost;
        return $this;
    }

    /**
     * Metodo responsavel em retornar o host a ser utilizado pelo servico
     *
     * @return string
     */
    public function getHost()
    {
        return $this->strHost;
    }

    /**
     * Metodo responsavel em setar a porta a ser utilizado pelo servico
     *
     * @param string $strPort            
     * @return \InepZend\WebSocket\WebSocketServer
     */
    public function setPort($strPort)
    {
        $this->strPort = $strPort;
        return $this;
    }

    /**
     * Metodo responsavel em retornar a porta a ser utilizado pelo servico
     *
     * @return string
     */
    public function getPort()
    {
        return $this->strPort;
    }
}
