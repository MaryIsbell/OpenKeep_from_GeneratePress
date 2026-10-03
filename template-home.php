<?php
/**
 * Template Name: Home (Custom Coded)
 *
 * Hand-coded instead of block-editor content so the Splide carousel markup
 * is guaranteed exact. Testimonials/accordion items are plain PHP arrays for
 * now; swap $testimonials for get_field('testimonials') later if this
 * content should become ACF-editable instead of hard-coded.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// TODO: replace with the real hero video once it's ready.
// The ID is the part of a YouTube link after "youtu.be/" or "watch?v=".
$hero_youtube_id = 'G1MpsXM3tPw';

$accordion_items = array(
	array(
		'summary' => 'Who we are',
		'body'    => 'Placeholder copy — replace with real content.',
	),
	array(
		'summary' => 'What we do',
		'body'    => 'Placeholder copy — replace with real content.',
	),
	array(
		'summary' => 'Why we do it',
		'body'    => 'Placeholder copy — replace with real content.',
	),
);

$testimonials = array(
	array(
		'quote' => 'There is something really magical that happens with open educational resources because the text becomes really a touchstone or an anchor that everyone can engage with because everyone has access to it.',
		'name'  => 'Diane Russo',
		'role'  => 'English Professor',
	),
	array(
		'quote' => 'There is something really magical that happens with open educational resources because the text becomes really a touchstone or an anchor that everyone can engage with because everyone has access to it.',
		'name'  => 'Diane Russo',
		'role'  => 'English Professor',
	),
	array(
		'quote' => 'There is something really magical that happens with open educational resources because the text becomes really a touchstone or an anchor that everyone can engage with because everyone has access to it.',
		'name'  => 'Diane Russo',
		'role'  => 'English Professor',
	),
);

get_header();
?>

	<div <?php generate_do_attr( 'content' ); ?>>
		<main <?php generate_do_attr( 'main' ); ?>>

			<?php while ( have_posts() ) : the_post(); ?>

			<div class="entry-content">

				<section class="ok-section-navy alignfull">
					<div class="ok-content-constrained">

						<h1 class="ok-hero-heading">Welcome to OpenKeep!</h1>
						<p class="ok-subhead">The Free, Open Source, Academic Publisher</p>

						<?php if ( $hero_youtube_id ) : ?>
							<div class="ok-video-frame">
								<iframe src="<?php echo esc_url( 'https://www.youtube-nocookie.com/embed/' . $hero_youtube_id . '?rel=0' ); ?>"
									title="Welcome to OpenKeep"
									allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
									referrerpolicy="strict-origin-when-cross-origin"
									allowfullscreen></iframe>
							</div>
						<?php endif; ?>
						<p class="ok-read-transcript"><a href="#">Read transcript</a></p>

						<?php foreach ( $accordion_items as $item ) : ?>
							<details class="ok-accordion-item">
								<summary><?php echo esc_html( $item['summary'] ); ?></summary>
								<p><?php echo esc_html( $item['body'] ); ?></p>
							</details>
						<?php endforeach; ?>

						<h2 class="ok-section-heading">Trusted by Academic Leaders</h2>

						<div class="splide">
							<div class="splide__track">
								<div class="splide__list">
									<?php foreach ( $testimonials as $testimonial ) : ?>
										<div class="splide__slide">
											<div class="ok-testimonial-card">
												<p class="ok-testimonial-quote"><?php echo esc_html( $testimonial['quote'] ); ?></p>
												<p class="ok-testimonial-name"><?php echo esc_html( $testimonial['name'] ); ?></p>
												<p class="ok-testimonial-role"><?php echo esc_html( $testimonial['role'] ); ?></p>
											</div>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						</div>

					</div>
				</section>

			</div>

			<?php endwhile; ?>

		</main>
	</div>

	<?php
	generate_construct_sidebars();
	get_footer();
