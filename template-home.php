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
		'summary' => 'What we do',
		'body'    => 'Our goal at OpenKeep is to create a clear path into academia. We do this by publishing Open Educational Resources (OER) authored by faculty, edited by students, and given away for free. OER can include any type of educational resource, from syllabi to full courses. ',
	),
	array(
		'summary' => 'How we do it',
		'body'    => 'High-quality educational resources are not free to produce or publish; we are able to give them away for free because we have woven OpenKeep into the curriculum at The University of New Haven. Students from any major interested in the publishing industry get hands-on experience with all stages of the publication process while bringing their expertise to the creation of engaging materials. Through a practicum offered by the English department, the editorial team works with faculty authors to produce resources that encourage students to engage.',
	),
	array(
		'summary' => 'What can we accomplish?',
		'body'    => 'OER aren’t just free to access; they are openly licensed, which means that they can be modified and redistributed by users. We design OER with iteration and adaptation in mind. We have published open editions of historic texts that grow each semester with student-authored annotations and collaborative glossaries refined each time they are used in the classroom.',
	),
);

$testimonials = array(
	array(
		'quote' => 'There is something really magical that happens with open educational resources because the text becomes really a touchstone or an anchor that everyone can engage with because everyone has access to it.',
		'name'  => 'Diane Russo',
		'role'  => 'Professor of Practice, English',
	),
	array(
		'quote' => 'Working with the OpenKeep editorial team has been a wonderful experience. The students are professional, responsive, and thoughtful in their work. I have been impressed with their ability to take my ideas and turn them into a polished product that is ready for publication.',
		'name'  => 'Danielle Cooper',
		'role'  => 'Professor, Criminal Justice',
	),
	array(
		'quote' => 'I have been writing a textbook for years. The OpenKeep team has helped me to finally get it published. They have been incredibly helpful and supportive throughout the entire process.',
		'name'  => 'Mark Tavern',
		'role'  => 'Assistant Professor of Practice, Music; Coordinator, B.A. in Music Industry',
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
						<p class="ok-subhead">Creating a clear path into academia</p>

						<?php if ( $hero_youtube_id ) : ?>
							<div class="ok-video-frame">
								<iframe src="<?php echo esc_url( 'https://www.youtube-nocookie.com/embed/' . $hero_youtube_id . '?rel=0' ); ?>"
									title="Welcome to OpenKeep"
									allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
									referrerpolicy="strict-origin-when-cross-origin"
									allowfullscreen></iframe>
							</div>
						<?php endif; ?>

						<?php foreach ( $accordion_items as $item ) : ?>
							<details class="ok-accordion-item">
								<summary><?php echo esc_html( $item['summary'] ); ?></summary>
								<p><?php echo esc_html( $item['body'] ); ?></p>
							</details>
						<?php endforeach; ?>

						<h2 class="ok-section-heading">Testimonials from Educators</h2>

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
