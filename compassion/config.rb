require 'compass/import-once/activate'
# require 'autoprefixer-rails'
# Require any additional compass plugins here.

add_import_path "bower_components/foundation-sites/scss"

# Set this to the root of your project when deployed:
http_path = "/"

css_dir="assets/css"
sass_dir="assets/sass"

# on_stylesheet_saved do |file|
#   css = File.read(file)
#   map = file + '.map'
# 
#   if File.exists? map
#     result = AutoprefixerRails.process(css,
#       from: file,
#       to:   file,
#       map:  { prev: File.read(map), inline: false })
#     File.open(file, 'w') { |io| io << result.css }
#     File.open(map,  'w') { |io| io << result.map }
#   else
#     File.open(file, 'w') { |io| io << AutoprefixerRails.process(css) }
#   end
# end
