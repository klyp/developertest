module.exports = function (grunt) {
    // load all grunt tasks
    require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

    grunt.initConfig({
        sass: {
            // Create compressed CSS file for Production
            dist: {
                options: {
                    style: 'compressed'
                },
                files: {
                    'css/main.css': 'css/main.scss',
                }
            },
            // Create non compressed CSS file for Development
            dev: {
                options: {
                    style: 'expanded'
                },
                files: {
                    'css/main.css': 'css/main.scss',
                }
            }
        },
        csso: {
            dist: {
                files: {
                'css/main.css': ['css/main.css']
                }
            }
        },
        uglify: {
            // Create compressed JS file for Production
            dist: {
                files: {
                    'js/main.min.js': ['js/plugins.js', 'js/main.js']
                }
            },

            // Create non compressed JS file for Development
            dev: {
                options: {
                    compress: false,
                    mangle: false,
                    beautify: true
                },
                files: {
                    'js/main.min.js': ['js/plugins.js', 'js/main.js']
                }
            }
        },
        watch: {
          // watch all SCSS files, if changed run the sass task
          sass: {
            files: ['css/*.scss'],
            tasks: ['sass:dev']
          },
          // watch and see if our javascript files change, if changed run the uglify-js task, will only rename main.js to main.min.js for development
          js: {
            files: ['js/main.js'],
            tasks: ['uglify:dev']
          },
          /* watch our files for change, reload */
          livereload: {
            files: ['*.html', 'css/*.css', 'img/*', 'js/{main.min.js, plugins.min.js}'],
            options: {
              livereload: true
            }
          },
        },

    });
    // create task for default, in this case runs all development tasks and watches for changes
    grunt.registerTask('default', ['sass:dev','uglify:dev','watch']);

    // create task to run when site is in production, will not watch files and will not live reload
    grunt.registerTask('dist', ['sass:dist','csso:dist','uglify:dist']);
};