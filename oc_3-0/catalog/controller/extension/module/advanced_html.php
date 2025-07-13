<?php
class ControllerExtensionModuleAdvancedHtml extends Controller {
    public function index($setting) {
        $this->load->language('extension/module/advanced_html');

        $data['heading_title'] = isset($setting['heading_title'][$this->config->get('config_language_id')]) ? $setting['heading_title'][$this->config->get('config_language_id')] : '';

        // Пример переменных для тестирования
        $data['categories'] = array(
            array(
                'category_id' => 1,
                'name' => 'Category 1',
                'children' => array(
                    array('category_id' => 11, 'name' => 'Subcategory 1.1'),
                    array('category_id' => 12, 'name' => 'Subcategory 1.2')
                )
            ),
            array(
                'category_id' => 2,
                'name' => 'Category 2',
                'children' => array()
            )
        );

        $data['show_categories'] = true;
        $data['current_category'] = 1;
        $data['simple_var'] = 'Simple variable';

        // Получаем HTML контент
        $html_content = isset($setting['description'][$this->config->get('config_language_id')]) ? $setting['description'][$this->config->get('config_language_id')] : '';

        // Рендерим Twig шаблон
        $loader = new \Twig\Loader\ArrayLoader([
            'advanced_html_template' => $html_content
        ]);

        $twig = new \Twig\Environment($loader);
        $data['html_content'] = $twig->render('advanced_html_template', $data);

        return $this->load->view('extension/module/advanced_html', $data);
    }
}