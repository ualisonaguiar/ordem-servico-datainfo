<?php 
$intLastModifiedTime = filemtime(__FILE__);
$strETag = md5_file(__FILE__);
header("Last-Modified: " . gmdate("D, d M Y H:i:s", $intLastModifiedTime) . " GMT");
header("Etag: " . $strETag);
header("Content-Type: text/javascript");
header("Cache-Control: max-age=604800, public, must-revalidate");
header("Pragma: max-age=604800, public, must-revalidate");
if ((is_null($mixZlib = ini_get("zlib.output_compression"))) || ($mixZlib == ""))
    ini_set("zlib.output_compression", true);
header("Accept-Encoding: gzip");
if ((@strtotime($_SERVER["HTTP_IF_MODIFIED_SINCE"]) == $intLastModifiedTime) || (trim(@$_SERVER["HTTP_IF_NONE_MATCH"]) == $strETag)) {
    header("HTTP/1.1 304 Not Modified");
    exit;
}
?>
/*global module:false*/
module.exports = function(grunt) {

  grunt.initConfig({

    // Metadata.
    pkg: grunt.file.readJSON('package.json'),
    banner: '/*! \n * <%= pkg.title || pkg.name %> v<%= pkg.version %>\n' +
      ' * <%= pkg.homepage %>\n' +
      ' * Copyright (c) <%= grunt.template.today("yyyy") %> <%= pkg.author %>\n' +
      ' * License: <%= pkg.license %>\n' +
      ' */\n',

    // Task configuration.
    uglify: {
      options: {
        banner: '<%= banner %>',
        report: 'gzip'
      },
      build: {
        src: 'src/loading-bar.js',
        dest: 'build/loading-bar.min.js'
      }
    },

    cssmin: {
      options: {
        banner: '<%= banner %>',
        report: 'gzip'
      },
      minify: {
        src: 'src/loading-bar.css',
        dest: 'build/loading-bar.min.css'
      }
    },

    karma: {
      unit: {
        configFile: 'test/karma-angular-1.2.conf.js',
        singleRun: true,
        coverageReporter: {
          type: 'text',
          dir: 'coverage/'
        }
      },
      unit13: {
        configFile: 'test/karma-angular-1.3.conf.js',
        singleRun: true,
        coverageReporter: {
          type: 'text',
          dir: 'coverage/'
        }
      },
      watch: {
        configFile: 'test/karma-angular-1.2.conf.js',
        singleRun: false,
        reporters: ['progress']  // Don't display coverage
      }
    },

    jshint: {
      jshintrc: '.jshintrc',
      gruntfile: {
        src: 'Gruntfile.js'
      },
      src: {
        src: ['src/*.js']
      }
    },

    concat: {
      build: {
        options: {
          banner: '<%= banner %>'
        },
        files: {
          'build/loading-bar.css': 'src/loading-bar.css',
          'build/loading-bar.js':  'src/loading-bar.js',
        }
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-karma');

  grunt.registerTask('default', ['jshint', 'karma:unit', 'karma:unit13', 'uglify', 'cssmin', 'concat:build']);
  grunt.registerTask('test', ['karma:watch']);
  grunt.registerTask('build', ['default']);

};
