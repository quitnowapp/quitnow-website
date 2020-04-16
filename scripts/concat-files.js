const concat = require('concat-files')
const minify = require('minify')
const fs = require('fs')

const bundle = (dest, files) =>
  new Promise((resolve, reject) =>
    concat(files, dest, err => {
      if (err) {
        reject(err)
      }
      console.log(`Bundle "${dest}" created`)
      resolve()
    })
  )
const reduce = (dest) =>
  minify(dest, {})
    .then(result => fs.writeFileSync(dest, result))
    .then(() => console.log(`Bundle "${dest}" minified`))
    .catch(console.error)

;(async () => {
  await bundle('css/bundle.css', [
    'css/main.css',
    'css/jquery.fullPage.css',
    'css/component.css',
  ])

  await bundle('js/bundle.js', [
    'js/jquery-2.1.3.min.js',
    'js/vendors/jquery.easings.min.js',
    'js/vendors/jquery.slimscroll.min.js',
    'js/jquery.fullPage.js',
    'js/circle-progress.js',
    'js/bezier-easing.js',
    'js/modernizr.custom.js',
    'js/draggabilly.pkgd.min.js',
    'js/elastiStack.js',
    'js/main.js',
  ])

  await reduce('css/bundle.css')
  await reduce('js/bundle.js')

  console.log('Done!')
})()
