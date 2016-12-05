<div class="toc">
<ul>
<li><a href="#cherry-customizer">Cherry Customizer</a><ul>
<li><a href="#_1">Аргументы модуля</a></li>
<li><a href="#panels">Panels</a></li>
<li><a href="#sections">Sections</a></li>
<li><a href="#controls">Controls</a><ul>
<li><a href="#_2">Типы контролов</a></li>
</ul>
</li>
</ul>
</li>
</ul>
</div>
<h1 id="cherry-customizer">Cherry Customizer</h1>
<p><strong>cherry-customizer</strong> - модуль, который упрощает работу с нативным функционалом WordPress Customizer API (<a href="https://developer.wordpress.org/themes/advanced-topics/customizer-api/">https://developer.wordpress.org/themes/advanced-topics/customizer-api/</a>)</p>
<p>Нативный Customizer API оперирует 4 основными сущностями - panel, section, settings, control. Данный модуль оставляет 3 - panel, section, control.</p>
<h2 id="_1">Аргументы модуля</h2>
<ul>
<li><strong>prefix</strong> - уникальный префикс, для предотвращения возможных конфликтов при добавлении sections, controls (например, слаг темы, плагина)</li>
<li><strong>capability</strong> - права, которыми должен обладать пользователь для коректной работы модуля (по-умолчанию, <code>edit_theme_options</code>)</li>
<li><strong>type</strong> - <code>_theme_mod_</code> или <code>_option_</code> (по-умолчанию, <code>theme_mod</code>). От этого параметра зависит, как настройки будут храниться в таблице wp_options: <ul>
<li><em>option</em> - настройки будут доступны всегда, независимо от активной темы (используеться для настроек плагина)</li>
<li><em>theme_mod</em> - настройки будут доступны только когда текущая тема активна (используеться для настроек темы)</li>
</ul>
</li>
<li><strong>options</strong> - набор опций (controls) сгрупированных по panels и/или sections.</li>
</ul>
<p><em>Пример инициализации:</em></p>
<pre><code>your_prefix_get_core()-&gt;init_module( 'cherry-customizer', array(
    'prefix'     =&gt; 'your_prefix',
    'capability' =&gt; 'edit_theme_options',
    'type'       =&gt; 'theme_mod',
    'options'    =&gt; array(),
) );
</code></pre>
<p>См. также в комментариях к модулю - <a href="https://github.com/CherryFramework/cherry-framework/blob/master/modules/cherry-customizer/cherry-customizer.php#L116-L154">https://github.com/CherryFramework/cherry-framework/blob/master/modules/cherry-customizer/cherry-customizer.php#L116-L154</a></p>
<blockquote>
<p>Вызывать инициализацию нужно на хук <code>after_setup_theme</code> с приоритетом не ниже 2 (предпочтительней 10).</p>
</blockquote>
<h2 id="panels">Panels</h2>
<p>Это самый верхний уровень иэрархии. Регистрация:</p>
<pre><code>'unique_panel_ID' =&gt; array(
    'title'           =&gt; esc_html__( 'Panel Title', 'text-domain' ),
    'description'     =&gt; esc_html__( 'Panel Description', 'text-domain' ),
    'priority'        =&gt; 140,
    'capability'      =&gt; '', (optional)
    'theme_supports'  =&gt; '', (optional)
    'active_callback' =&gt; '', // (optional: is_front_page, is_single)
    'type'            =&gt; 'panel', // panel, section or control (*).
),
</code></pre>
<ul>
<li><em>unique_panel_ID</em></li>
<li><em>title</em> - имя</li>
<li><em>description</em> - описание</li>
<li><em>priority</em> - приоритет (влияет на порядок). Приоритеты дэфолтных секций, добавленых из ядра - <a href="https://developer.wordpress.org/themes/advanced-topics/customizer-api/#sections">https://developer.wordpress.org/themes/advanced-topics/customizer-api/#sections</a></li>
<li><em>capability</em> - если нужны другие права пользователя, указаные при инициализации модуля</li>
<li><em>active_callback</em> - callback-функция, определяет когда показывать панель</li>
</ul>
<blockquote>
<p>Панель может содержать только секции.</p>
</blockquote>
<h2 id="sections">Sections</h2>
<p>Может быть как верхним, так и промежуточным уровнем между панелями и контролами. Регистрация:</p>
<pre><code>'unique_section_ID' =&gt; array(
    'title'       =&gt; esc_html__( 'Section Title', 'text-domain' ),
    'description' =&gt; esc_html__( 'Section Description', 'text-domain' ),
    'priority'    =&gt; 10, (10, 20, 30, ...)
    'panel'       =&gt; 'unique_panel_ID', (*)
),
</code></pre>
<ul>
<li><em>unique_section_ID</em></li>
<li><em>title</em> - имя</li>
<li><em>description</em> - описание</li>
<li><em>priority</em> - приоритет (влияет на порядок)</li>
<li><em>panel</em> - ID родительской панели</li>
</ul>
<blockquote>
<p>Панели и секции могут регистрироваться на одном уровне.</p>
<p>Секция может содержать только контролы.</p>
</blockquote>
<h2 id="controls">Controls</h2>
<p>Сущность, которая по-сути и есть опцией. Регистрация:</p>
<pre><code>'unique_control_ID' =&gt; array(
    'title'       =&gt; esc_html__( 'Control Title', 'text-domain' ),
    'description' =&gt; esc_html__( 'Control Description', 'text-domain' ),
    'section'     =&gt; 'unique_section_ID', (*)
    'default'     =&gt; '',
    'field'       =&gt; 'text',  // text, textarea, checkbox, radio, select, iconpicker, fonts, hex_color, image, file.
    'choices'     =&gt; array(), // for `select` and `radio` field.
    'type'        =&gt; 'control', (*)
    'active_callback'      =&gt; '', (optional: is_front_page, is_single)
    'transport'            =&gt; 'refresh', // refresh or postMessage (default: refresh)
    'sanitize_callback'    =&gt; '', (optional) Maybe need to use a custom function or sanitization.
),
</code></pre>
<ul>
<li><em>unique_control_ID</em></li>
<li><em>title</em> - имя</li>
<li><em>description</em> - описание</li>
<li><em>section</em> - ID родительской секции</li>
<li><em>default</em> - знамение по-умолчянию</li>
<li><em>field</em> - тип контрола</li>
<li><em>choise</em> - варианты значений для контролов select, radio</li>
<li><em>active_callback</em> - callback-функция, определяет когда показывать контрол</li>
<li><em>transport -</em> refresh или postMessage (способ обработки значения)</li>
<li><em>sanitize_callback -</em> кастомная функция для валидации значения перед сохранением в базу</li>
</ul>
<blockquote>
<p>Контрол может находится только в секции</p>
</blockquote>
<h3 id="_2">Типы контролов</h3>
<p>Модуль поддерживает след. типы контролов (от типа зависит обработка и валидация значения перед сохранением в базу):</p>
<ul>
<li>text</li>
<li>textarea</li>
<li>email</li>
<li>url</li>
<li>password</li>
<li>checkbox</li>
<li>range</li>
<li>number</li>
<li>select</li>
<li>fonts - список фонтов (системные + Google Web Fonts)</li>
<li>radio</li>
<li>hex_color</li>
<li>image</li>
<li>file</li>
<li>iconpicker - для выбора иконки</li>
</ul>