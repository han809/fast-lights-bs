<?php
/**
 * Template Name: Gallery
 */
get_header();
?>
<main>
<div class="page" id="p-gallery">
<section class="gl-hero art-dusk"><div class="container"><h1>Photo<span>Gallery</span></h1><p>Hamare sets, gear aur crew ki tasveerein.</p></div></section>
<section class="sec"><div class="container"><div class="chips"><button class="chip on" data-f="all">All</button><button class="chip" data-f="gear">Gear</button><button class="chip" data-f="crew">Crew</button><button class="chip" data-f="studio">Studio</button></div><div class="mas"><a class="t a1 art-t0" data-c="gear" data-l="Camera Package" href="#"></a><a class="t a3 art-t1" data-c="gear" data-l="Lighting Setup" href="#"></a><a class="t a2 art-t2" data-c="crew" data-l="On-set Crew" href="#"></a><a class="t a4 art-t3" data-c="gear" data-l="Grip Truck" href="#"></a><a class="t a3 art-t4" data-c="studio" data-l="Studio Floor" href="#"></a><a class="t a1 art-t5" data-c="studio" data-l="Green Room" href="#"></a><a class="t a2 art-t6" data-c="gear" data-l="Power &amp; Cable" href="#"></a><a class="t a4 art-t7" data-c="crew" data-l="Crew at Work" href="#"></a><a class="t a3 art-t8" data-c="studio" data-l="Soundstage" href="#"></a><a class="t a1 art-t9" data-c="crew" data-l="Gaffer Team" href="#"></a><a class="t a2 art-t10" data-c="studio" data-l="Studio Lights" href="#"></a><a class="t a3 art-t11" data-c="gear" data-l="Delivery" href="#"></a></div></div></section>
<section class="ctabar"><div class="container"><div class="cin art-ctabg"><div><h3>Apna project shuru karein</h3><p>Hum aap ki production ka hissa banna chahte hain.</p></div><div class="btns" style="margin:0"><a class="btn btn-primary" href="<?php echo esc_url(fl_url('contact')); ?>" style="background:var(--amber);border-color:var(--amber);color:#1a1200!important">Get a Quote</a><a class="btn btn--ghost btn-outline-light" href="tel:<?php echo esc_attr(fl_tel()); ?>"><svg aria-hidden="true" class="ico" fill="none" height="18" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" viewbox="0 0 24 24" width="18"><path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2z"></path></svg> Call Us</a></div></div></div></section>
</div>
</main>
<?php get_footer();
