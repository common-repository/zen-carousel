=== Zen-Carousel ===
Contributors: sirpengi
Donate link: http://freelanceDreams.com/
Tags: dojo,carousel,javascript
Requires at least: 2.9
Tested up to: 2.9
Stable tag: 0.1.1

== Description ==

Dojo-powered carousel plugin for Wordpress. Initially started out as a modification of XEN Carousel, but I made so many edits (and switched JS backend to Dojo) that no code of the original plugin remains.

# Showcase images on the front of your site, with arbitrary links
# Dojo powered (all other WP plugins seem to be JQuery-based)
# Graceful fallback behavior (if JS is not enabled then static first image w/ link is still visible)
# Navigation for quick jumping (ala Steam showcase)

In its current state, integration requires some measure of manual setup. Please be patient (and submit requests) as later updates will bring smoother install.

Please see http://bitbucket.org/sirpengi/zen-carousel/ for latest code, reporting bugs or requesting features.

== Installation ==

1. Install plugin through Wordpress interface or by extracting files to `/wp-content/plugins/`
1. Activate plugin through 'Plugins' menu in Wordpress
1. Visit admin page, a new section 'Carousel' in the sidebar should lead you to configuration page.
1. Please make sure 'Use CDN' is checked (This will pull Dojo library from google CDN, if you already include Dojo in your page through other means, leave this unchecked).
1. Set width/height dimensions of your carousel.
1. Input data (this is currently done through a manual textarea field, see 'Faq' for syntax.
1. Add `<?php zencarousel::renderHTML(); ?>` in your theme where you want the carousel to be.

== Frequently Asked Questions ==

= Options =
`Use Dojo CDN: check unless your theme already includes Dojo
Carousel Width: width of carousel
Carousel Height: height of carousel`

= Carousel Setup =
The setup uses the following line format:

`
<Image url> <Link to> <Title>
<Image url> is the url (absolute or relative) to the image
<Link to> is the url that clicking this photo will lead to.
<Title> for accessibility, shows up as tooltip for image/link
`

Separate each value with a space. The code only splits into three parts so spaces in the 'Title' are allowed.

For example:

`
http://domain.com/image/slide1.png http://domain.com/coolpage/ This is my cool page
http://domain.com/image/slide2.png http://domain.com/coolpage2/ This is my 2nd cool page
http://domain.com/image/slide3.png http://domain.com/coolpage3/ This is my 3rd cool page
`

== Screenshots ==

1. Example output

== Upgrade Notice ==

= 0.1 =
This is the initial release. Have fun! Please report bugs, make feature requests!

== Changelog ==

= 0.1 = 
* Initial output

== License ==

The Zen-Carousel plugin was developed by Shu Zong Chen of freelancedreams.com.
This plugin is provided under the Modified BSD License.

Copyright (c) 2010, Shu Zong Chen (email : shu.chen@freelancedreams.com)
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:
    * Redistributions of source code must retain the above copyright
      notice, this list of conditions and the following disclaimer.
    * Redistributions in binary form must reproduce the above copyright
      notice, this list of conditions and the following disclaimer in the
      documentation and/or other materials provided with the distribution.
    * Neither the name of the <organization> nor the
      names of its contributors may be used to endorse or promote products
      derived from this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL <COPYRIGHT HOLDER> BE LIABLE FOR ANY
DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
