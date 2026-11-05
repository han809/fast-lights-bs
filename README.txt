FAST LIGHTS (BOOTSTRAP) - WordPress theme
==========================================
Install: Appearance > Themes > Add New > Upload Theme > fast-lights-bs.zip > Activate.

On activation the theme automatically:
  - creates pages Home, About Us, Services, Gallery, Blog, Contact Us (skips ones that exist)
  - assigns the matching page templates (About / Services / Gallery / Contact)
  - sets Home as the front page and Blog as the posts page
  - builds the "Fast Lights Primary" menu and assigns it to the Primary location
  - adds 6 sample blog posts (only if the site has no posts yet)

Where to edit
  - Phone / email / address / hours : Appearance > Customize > Fast Lights Contact
  - Menu                            : Appearance > Menus
  - Blog posts                      : Posts (featured image = blog card image)
  - Page text / sections            : the template files (front-page.php, page-about.php, page-services.php,
                                      page-gallery.php, page-contact.php) - plain HTML + Bootstrap classes
  - Images                          : the gallery / hero images are generated placeholders (assets/css/art.css).
                                      Replace the .art-* classes with <img> or CSS backgrounds of real photos.
  - Forms                           : all forms post to admin-post.php (action fl_contact) and are emailed to the
                                      address set in Customize. Spam protection: nonce + honeypot.

Files
  style.css, functions.php, header.php, footer.php, front-page.php, page-*.php, home.php (blog), single.php,
  page.php, archive.php, search.php, 404.php, sidebar-blog.php, inc/*.php, assets/{css,js,vendor}
