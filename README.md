# oc_module

Для OpenCart 1.5 (TPL синтаксис)
В поле "Описание" можно вставить:

<h3>{{ simple_var }}</h3>

{% if show_categories %}
<ul class="category-list">
  {% for category in categories %}
  <li>
    {{ category.name }}
    {% if category.children %}
    <ul>
      {% for child in category.children %}
      <li {% if child.category_id == current_category %}class="active"{% endif %}>
        {{ child.name }}
      </li>
      {% endfor %}
    </ul>
    {% endif %}
  </li>
  {% endfor %}
</ul>
{% else %}
<p>Категории скрыты</p>
{% endif %}

Для OpenCart 3.0 (Twig синтаксис)
В поле "Описание" можно вставить:

<h3>{{ simple_var }}</h3>

{% if show_categories %}
<ul class="category-list">
  {% for category in categories %}
  <li>
    {{ category.name }}
    {% if category.children %}
    <ul>
      {% for child in category.children %}
      <li class="{{ child.category_id == current_category ? 'active' : '' }}">
        {{ child.name }}
      </li>
      {% endfor %}
    </ul>
    {% endif %}
  </li>
  {% endfor %}
</ul>
{% else %}
<p>Categories are hidden</p>
{% endif %}