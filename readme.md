# Kittens for Comments #
**Contributors:** willthewebmechanic
**Tags:** comments, blog
**Requires at least:** 3.9
**Tested up to:** 4.4
**Stable tag:** 3.0.2
**License:** GPLv3

Encourages your readers to leave comments with the promise of a kitten picture.  Who doesn't love kittens?

## Description ##

You've poured your heart and soul in to writing fascinating blog posts.  You know you have a lot of readership, but nobody except your mom is leaving comments.  That's a bit discouraging right?  Entice your readers to leave comments by giving them a picture of a cute kitten in return.

Just prior to the comment form coming in to view, an unobtrusive panel will be displayed with a short message that says: "Your comments make us happy.  Leave a comment, get a kitten!"

 

When a comment is submitted, a picture of an adorable kitten is displayed in a modal window.

Caveats:

This plugin assumes that your comment form is A) built with the 'comment_form' WordPress function and B) that your comment form has an id of "commentform" (This is the WordPress default, but your theme developer may have changed the behavior for whatever reason.
This plugin assumes that comment forms only appear on single posts and only loads the code when a single post (or page) is loaded.
 

## Installation ##

Extract the zip file and just drop the contents in the wp-content/plugins/ directory of your WordPress installation and then activate the Plugin from Plugins page.
## Frequently Asked Questions ##

What are the known limitations?

As of right now, there are several:

1.  This plugin assumes that the comment form has an id of "commentform", which is the WordPress default, but if your theme overrides that then this plugin isn't going to do anything for you.  There are plans to remedy this, but I won't go to the trouble unless you ask for it.
2.  There hasn't been much consideration given to they styling of the modal display.  It may not work very well with your theme.
3.  There is absolutely no customization options nor settings for this plugin.  If you need options, please ask and I will do my best to implement that.
## Screenshots ##

###1. The panel that appears when your comment form comes in to view###
![The panel that appears when your comment form comes in to view](http://s-plugins.wordpress.org/kittens-for-comments/trunk/screenshot-1.png)


###2. Kitten!###
![Kitten!](http://s-plugins.wordpress.org/kittens-for-comments/trunk/screenshot-2.png)


## Changelog ##

### 3.0.2 ###
1. Tested agaist WordPress 4.4
2. updated external assets
3. change loading of CSS/JavaScript for SCRIPT_DEBUG
4. minified CSS & JavaScript

### 3.0.1 ###
1. Tested against WordPress 4.3-RC2
2. Removed spammy links
3. PHP warning fix

### 3.0 ###
code cleaned up, verified compatiblity with WordPress 3.9 and now has its own place in the admin menu.
### 2.0 ###
fancybox replaced with colorbox to comply with GPL compatible licensing.
### 1.1 ###
Now uses jquery fancybox to display the kitten picture. This change goes a long way toward making the image fit all screen sizes.
### 1.0 ###
initial release

##Other Information##
I created this plugin for my own amusement and am offering it for you to use as you wish.  If you find it useful but would like more features, please do ask.
