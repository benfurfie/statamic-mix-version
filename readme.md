Laravel Mix is awesome. However, one of its most powerful features is the `version()` API. Statamic Mix allows you to easily make use of this powerful feature within your Statamic site.

Out of the box, Laravel Mix generates a manifest.json file. However, that small file's true power comes into play when you make use of the version API within Mix. By adding `mix.version()` to your Mix config file, you can output cache busting version strings to your assets.

This plugin makes it super easy to output your theme assets (CSS/JS) with this cache string attached.

## Installation
Download the file and drop the `Mix` folder in your `site/addons` folder. It will install automatically.

## Configuration
Assuming you're already making use of Statamic's awesome `theme:css` and `theme:js` tags, all you need to do to move over to using the Mix version() version (yeah, double names are confusing) is change `theme` to `mix`. I.e:

`{{ theme:css }}` would become `{{ mix:css }}`.

## Additional Notes
As with the `{{ theme:css }}` and `{{ theme:js }}` tags, you can also choose to define a different name for your CSS and JS files. For example, I like using `app.css` and `app.js` in my projects. So all I have to do is add `{{ mix:css src="app" }}` to the name and it works.

You can also use the `tag="output"` option too to output the html! Super easy, right!?

## Other things to consider
Aside from the fact that there are far nicer bourbons out there than Jack Daniels, it's worth noting that this plugin plays nicely – I mean really nicely – with [Erin Dalzell's TailwindCSS addon](https://statamic.com/marketplace/addons/tailwind). I strongly recommend looking at it as it's a really nice implementation of Mix with some additional sprinkles on top.