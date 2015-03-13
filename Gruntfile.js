module.exports = function(grunt) {

  grunt.initConfig({

    concat: {
      js: {
        src: [
          './bower_components/jquery/dist/jquery.js',
          './bower_components/bootstrap-sass/assets/javascripts/bootstrap.js',
          './app/assets/javascripts/*.js',
        ],
        dest: './public/assets/javascripts/application.js'
      }
    },
    uglify: {
      options: {
        mangle: false
      },
      js: {
        files: {
          './public/assets/javascripts/application.js': './public/assets/javascripts/application.js'
        }
      }
    },
    sass: {
      development: {
        options: {
          style: 'compressed'
        },
        files: {
          "./public/assets/stylesheets/application.css":"./app/assets/stylesheets/application.sass"
        }
      }
    },
    watch: {
      js: {
        files: [
          './bower_components/jquery/dist/jquery.js',
          './bower_components/bootstrap-sass/assets/javascripts/bootstrap.js',
          './app/assets/javascripts/*.js'
        ],
        tasks: ['concat:js', 'uglify:js']
      },
      sass: {
        files: ['./app/assets/stylesheets/*.sass'],
        tasks: ['sass']
      }
    },
    copy: {
      main: {
        files: [
          {
            cwd: 'bower_components/font-awesome/fonts/',  // set working folder / root to copy
            src: '**/*',           // copy all files and subfolders
            dest: 'public/assets/fonts',    // destination folder
            expand: true           // required when using cwd
          },
          {
            cwd: 'bower_components/bootstrap-sass/assets/fonts/',  // set working folder / root to copy
            src: '**/*',           // copy all files and subfolders
            dest: 'public/assets/fonts',    // destination folder
            expand: true           // required when using cwd
          }
        ]
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-copy');

  grunt.registerTask('default', ['watch']);
}
