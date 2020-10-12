<?php
add_filter('wpcf7_load_js', '__return_false');
add_filter('wpcf7_load_css', '__return_false');

add_filter('style_loader_tag', 'sj_remove_type_attr', 10, 2);
add_filter('script_loader_tag', 'sj_remove_type_attr', 10, 2);
function sj_remove_type_attr ($tag) {
	return preg_replace("/type=['\"]text\/(javascript|css)['\"]/", '', $tag);
}

add_post_type_support('page', 'excerpt');

add_action('after_setup_theme', function() {
	register_nav_menus([
		'header_menu' => 'Меню в шапке',
		'main_menu' => 'Основное меню',
		'footer_first_menu' => 'Первое меню в подвале',
		'footer_second_menu' => 'Второе меню в подвале',
		'footer_third_menu' => 'Третье меню в подвале',
		'footer_fourth_menu' => 'Четвертое меню в подвале'
	]);
});

add_theme_support('post-thumbnails', array('post', 'page', 'project'));
add_image_size('w80h80', 80, 80, true);
add_image_size('w360h240', 360, 240, true);
add_image_size('w360h360', 360, 360, true);
add_image_size('w400h260', 400, 260, true);
add_image_size('w600h340', 600, 340, true);
add_image_size('w800h460', 800, 460, true);
add_image_size('w800h800', 800, 800, true);
add_image_size('w200h500', 200, 500, true);

function srcset($image, $wh) {
	$wh = !empty($wh) ? $wh : ['thumbnail', 'medium', 'large', 'w150h100', 'w560h308', 'w468h364', 'w560h308', 'w468h500', 'w800h600', 'w800h480'];

	$srcset = [];
	foreach ($wh as $size) {
		$srcset[] = $image['sizes'][$size] . ' ' . $image['sizes'][$size . '-width'] . 'w';
	}
	$srcset[] = $image['url'] . ' ' . $image['width'] . 'w';

	$sizes = [];
	foreach ($wh as $size) {
		$sizes[] = '(max-width: ' . $image['sizes'][$size . '-width'] . 'px) ' . $image['sizes'][$size . '-width'] . 'px';
	}
	$sizes[] = $image['width'] . 'px';

	return 'srcset="' . implode(', ', $srcset) . '" ' . 'sizes="' . implode(', ', $sizes) . '"';
}

function icon($name, $scale = 1) {
	$width = $scale * 20;
	$height = $scale * 20;
	echo '<svg class="ui-icon" width="' . $width . '" height="' . $height . '"><use xlink:href="' . get_bloginfo('template_url') . '/dist/images/sprite.svg#' . $name . '"></use></svg>';
}

function print_oembed($iframe) {
	preg_match('/src="(.+?)"/', $iframe, $matches);
	$src = $matches[1];
	$params = array(
			'controls' => 0,
			'hd' => 1,
			'autohide' => 1
	);
	$new_src = add_query_arg($params, $src);
	$iframe = str_replace($src, $new_src, $iframe);
	$attributes = 'frameborder="0"';
	$iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);
	echo $iframe;
}

function print_time_ago($post) {
	echo human_time_diff(get_the_time('U', $post), current_time('timestamp')) . ' назад';
}

if (function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'page_title' 	=> 'Параметры',
		'menu_title'	=> 'Параметры',
		'menu_slug' 	=> 'acf-options',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}

function template_part( $atts, $content = null ){
	$tp_atts = shortcode_atts(array(
		 'path' =>  null,
	), $atts);
	ob_start();
	get_template_part($tp_atts['path']);
	$ret = ob_get_contents();
	ob_end_clean();
	return $ret;
}
add_shortcode('template_part', 'template_part');

remove_action('wp_head', 'rel_canonical');

function seo_canonical() {
	if ( ! is_singular() ) {
		return;
	}

	$id = get_queried_object_id();

	if ( 0 === $id ) {
		return;
	}

	$url = wp_get_canonical_url( $id );

	if ( ! empty( $url ) ) {
		echo '<link rel="canonical" itemprop="url" href="' . esc_url( $url ) . '" />' . "\n";
	}
}

function seo() {
	$title = '';
	$description = '';
	$keywords = '';

	if (is_archive()) {
		$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
		if ($term) {
			$title = get_field('title', $term->taxonomy . '_' . $term->term_id);
			if (empty($title)) {
				$title = $term->name;
			}
			$description = get_field('description', $term->taxonomy . '_' . $term->term_id);
			$keywords = get_field('keywords', $term->taxonomy . '_' . $term->term_id);
		} elseif (is_post_type_archive()) {
			$title = get_queried_object()->labels->name;
		} elseif (is_day()) {
			$title = sprintf(__('Daily Archives: %s', 'roots'), get_the_date());
		} elseif (is_month()) {
			$title = sprintf(__('Monthly Archives: %s', 'roots'), get_the_date('F Y'));
		} elseif (is_year()) {
			$title = sprintf(__('Yearly Archives: %s', 'roots'), get_the_date('Y'));
		} elseif (is_author()) {
			$author = get_queried_object();
			$title = sprintf(__('Author Archives: %s', 'roots'), $author->display_name);
		} else {
			$title = single_cat_title('', false);
		}
	} elseif (is_search()) {
		$title = sprintf(__('Search Results for %s', 'roots'), get_search_query());
	} elseif (is_404()) {
		$title = 'Not Found';
	} else {
		$title = get_field('seo_title');
		if (empty($title)) {
			$title = get_the_title();
		}
		$description = get_field('seo_description');
		$keywords = get_field('seo_keywords');
	}

	echo '<title>' . $title . '</title>';
	if (!empty($description)) {
		echo '<meta name="keywords" content="' . $keywords . '">';
	}
	if (!empty($keywords)) {
		echo '<meta name="description" content="' . $description . '">';
	}
}

add_action('wp_enqueue_scripts', function () {
	wp_deregister_script('jquery');
	wp_enqueue_script('theme_main', get_template_directory_uri() . '/dist/main.js', [], false, true);

	wp_localize_script('theme_main', 'myajax', [
		'url' => admin_url('admin-ajax.php')
	]);
}, 99);


function is_weeks($datetime, $data) {
	// это Святки, дата фиксированна
	if ($datetime->format('m') == 1 && ($datetime->format('d') > 7 && $datetime->format('d') < 18)) {
		return true;
	}

	// в описании есть слова "Седмица сплошная"
	if (strpos($data->fasting->weeks, 'Седмица сплошная') !== false) {
		return true;
	}

	// в описании есть слова "Седмица cырная (мясопустная) - сплошная"
	if (strpos($data->fasting->weeks, 'Седмица cырная (мясопустная) - сплошная') !== false) {
		return true;
	}

	// в описании есть слова "Светлая седмица – сплошная"
	if (strpos($data->fasting->weeks, 'Светлая седмица – сплошная') !== false) {
		return true;
	}

	// в описании есть слова "Троицкая"
	if (strpos($data->fasting->weeks, 'Троицкая') !== false) {
		return true;
	}

	// ничего не найдено
	return false;
}

function is_commemoration($datetime, $data) {
	// дата 9 мая фиксированна
	if ($datetime->format('m') == 5 && $datetime->format('d') == 9) {
		return true;
	}

	// в описании есть слова "Поминовение усопших"
	if (strpos($data->fasting->weeks, 'Поминовение усопших') !== false) {
		return true;
	}

	// в описании есть слова "Вселенская родительская (мясопустная) суббота"
	if (strpos($data->fasting->weeks, 'Вселенская родительская (мясопустная) суббота') !== false) {
		return true;
	}

	// в описании есть слова "Троицкая родительская суббота"
	if (strpos($data->fasting->weeks, 'Троицкая родительская суббота') !== false) {
		return true;
	}

	// определяем по празднику
	foreach ($data->holidays as $item) {
		if ($item->title == 'Димитриевская родительская суббота') {
			return true;
		}
	}

	// ничего не найдено
	return false;
}

function is_holidays($datetime, $data) {
	if (empty($data->holidays)) {
		return false;
	}

	if (!is_array($data->holidays)) {
		return false;
	}

	return count(array_filter($data->holidays, function ($row) {
		return $row->marked == 1;
	})) > 0;
}

function is_fasting($datetime, $data) {
	if (!empty($data->fasting->fasting)) {
		return true;
	}

	return false;
}

add_action('wp_ajax_get_calendar_data', 'ajax_get_calendar_data', 10, 2);
add_action('wp_ajax_nopriv_get_calendar_data', 'ajax_get_calendar_data', 10, 2);
function ajax_get_calendar_data() {
	$dates = $_POST['dates'];

	if (!$dates) {
		wp_die();
	}

	$dates_array = explode(',', $dates);
	$output = [];

	foreach ($dates_array as $date) {
		$datetime = DateTime::createFromFormat('Y-m-d', $date);
		$cache_key = 'ecalendar-' . $datetime->format('Y-m-d');

		$data = get_transient($cache_key);
		if (empty($data)) {
			$url = 'https://azbyka.ru/days/api/day/' . $datetime->format('Y-m-d') . '.json';

			$response = json_decode(file_get_contents($url));

			$texts = [];
			foreach ($response->texts as $item) {
				$texts[] = $item->text;
			}

			$saints = [];
			foreach ($response->saints as $item) {
				$saints[] = $item->title;
			}

			$data = [
				'is_fasting' => is_fasting($datetime, $response),
				'is_holidays' => is_holidays($datetime, $response),
				'is_weeks' => is_weeks($datetime, $response),
				'is_commemoration' => is_commemoration($datetime, $response),
				'saints' => implode(', ', $saints),
				'texts' => implode(', ', $texts),
				'fasting' => $response->fasting->round_week
			];

			set_transient($cache_key, $data, MONTH_IN_SECONDS);
		}

		$output[$date] = $data;
	}

	echo json_encode($output);

	wp_die();
}

add_action( 'init', function () {
	$post_type = 'post';
	$post_type_object = get_post_type_object($post_type);
	$post_type_object->has_archive = true;
	register_post_type($post_type, $post_type_object);
});

add_action('init', 'register_video_post_type_init');
function register_video_post_type_init() {
	$labels = [
		'name' => 'Видео',
		'singular_name' => 'Видео',
		'add_new' => 'Добавить видео',
		'add_new_item' => 'Добавить новое видео',
		'edit_item' => 'Редактировать видео',
		'new_item' => 'Новое видео',
		'all_items' => 'Все видео',
		'view_item' => 'Просмотр видео на сайте',
		'search_items' => 'Искать видео',
		'not_found' =>  'Видео не найдено.',
		'not_found_in_trash' => 'В корзине нет видео.',
		'menu_name' => 'Видео'
	];
	$args = [
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'menu_icon' => 'dashicons-format-video',
		'menu_position' => 20,
		'supports' => ['title'],
		'taxonomies' => ['video_tag', 'video_category']
	];
	register_post_type('video', $args);
}

add_action('init', 'register_video_tag_taxonomy');
function register_video_tag_taxonomy() {
	register_taxonomy('video_tag', ['video'], [
		'label' => '',
		'labels' => [
			'name' => 'Теги',
			'singular_name' => 'Тег',
			'search_items' => 'Поиск тегов',
			'all_items' => 'Все теги',
			'view_item ' => 'Смотреть тег',
			'parent_item' => 'Родительский тег',
			'parent_item_colon' => 'Родительский тег:',
			'edit_item' => 'Редактировать тег',
			'update_item' => 'Изменить тег',
			'add_new_item' => 'Добавить новый тег',
			'new_item_name' => 'Название нового тега',
			'menu_name' => 'Теги'
		],
		'description' => '',
		'public' => true,
		'hierarchical' => false,
		'rewrite' => true,
		'capabilities' => [],
		'meta_box_cb' => null,
		'show_admin_column' => false,
		'show_in_rest' => null,
		'rest_base' => null
	]);
	register_taxonomy('video_category', ['video'], [
    'label' => 'Рубрики видео',
    'labels' => [
      'name' => 'Рубрики видео',
      'singular_name' => 'Рубрики видео',
      'search_items' => 'Искать рубрики',
      'all_items' => 'Все рубрики',
      'parent_item' => 'Родит. рубрика',
      'parent_item_colon' => 'Родит. рубрика:',
      'edit_item' => 'Редактировать рубрику',
      'update_item' => 'Обновить рубрику',
      'add_new_item' => 'Добавить рубрику',
      'new_item_name' => 'Заголовок',
      'menu_name' => 'Рубрики видео',
    ],
    'description' => 'Рубрики для видео',
    'public' => true,
    'show_in_nav_menus' => true,
    'show_ui' => true,
    'show_tagcloud' => false,
    'hierarchical' => true,
    'rewrite' => ['hierarchical' => true],
    'show_admin_column' => true,
  ]);
}
