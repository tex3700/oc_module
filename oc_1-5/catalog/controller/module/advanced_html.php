<?php
class ControllerModuleAdvancedHtml extends Controller {
    public function index($setting) {
        $this->language->load('module/advanced_html');

        $data['heading_title'] = isset($setting['heading_title'][$this->config->get('config_language_id')]) ? $setting['heading_title'][$this->config->get('config_language_id')] : '';

        // Пример переменных для тестирования
        $data['categories'] = array(
            array(
                'category_id' => 1,
                'name' => 'Категория 1',
                'children' => array(
                    array('category_id' => 11, 'name' => 'Подкатегория 1.1'),
                    array('category_id' => 12, 'name' => 'Подкатегория 1.2')
                )
            ),
            array(
                'category_id' => 2,
                'name' => 'Категория 2',
                'children' => array()
            )
        );

        $data['show_categories'] = true;
        $data['current_category'] = 1;
        $data['simple_var'] = 'Простая переменная';

        // Получаем HTML контент
        $html_content = isset($setting['description'][$this->config->get('config_language_id')]) ? $setting['description'][$this->config->get('config_language_id')] : '';

        // Создаем временный файл шаблона
        $template_file = DIR_CACHE . 'advanced_html_' . md5($html_content) . '.tpl';
        file_put_contents($template_file, $html_content);

        // Рендерим шаблон
        ob_start();
        extract($data);
        include($template_file);
        $data['html_content'] = ob_get_clean();

        // Удаляем временный файл
        unlink($template_file);

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/advanced_html.tpl')) {
            return $this->load->view($this->config->get('config_template') . '/template/module/advanced_html.tpl', $data);
        } else {
            return $this->load->view('default/template/module/advanced_html.tpl', $data);
        }
    }
}
