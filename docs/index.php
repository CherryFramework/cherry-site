<div class="toc">
<ul>
<li><a href="#cherry-customizer">Cherry Customizer</a><ul>
<li><a href="#module-arguments">Module arguments</a></li>
<li><a href="#panels">Panels</a></li>
<li><a href="#sections">Sections</a></li>
<li><a href="#controls">Controls</a><ul>
<li><a href="#control-types">Control Types</a></li>
</ul>
</li>
</ul>
</li>
<li><a href="#cherry-handler">Cherry Handler</a><ul>
<li><a href="#description">Description</a></li>
<li><a href="#sample-creation">Sample creation</a></li>
<li><a href="#back-end-initialization">Back-end initialization</a></li>
<li><a href="#front-end-initialization">Front-end initialization</a></li>
<li><a href="#display-system-messages">Display system messages</a></li>
</ul>
</li>
<li><a href="#cherry-dynamic-css">Cherry Dynamic CSS</a><ul>
<li><a href="#general-description">General Description</a></li>
<li><a href="#module-arguments_1">Module Arguments</a></li>
<li><a href="#functions">Functions</a><ul>
<li><a href="#available-functions">Available functions</a></li>
<li><a href="#user-function-addition">User function addition</a></li>
</ul>
</li>
<li><a href="#available-hooks">Available hooks</a><ul>
<li><a href="#actions">Actions</a></li>
<li><a href="#filters">Filters</a></li>
</ul>
</li>
<li><a href="#adding-inline-styles">Adding inline styles</a></li>
</ul>
</li>
<li><a href="#cherry-js-core">Cherry JS Core</a><ul>
<li><a href="#general-description_1">General description</a></li>
<li><a href="#main-js-object-structure-description">Main JS object structure description</a><ul>
<li><a href="#expressions">Expressions</a></li>
<li><a href="#utilities">Utilities</a></li>
</ul>
</li>
</ul>
</li>
<li><a href="#cherry-template-manager">Cherry Template Manager</a><ul>
<li><a href="#general-description_2">General Description</a></li>
<li><a href="#files-structure">Files structure</a></li>
<li><a href="#module-arguments_2">Module arguments</a></li>
<li><a href="#module-methods">Module methods</a><ul>
<li><a href="#parsed_template">parsed_template</a><ul>
<li><a href="#callback-variables-filters">Callback &amp; variables filters</a></li>
</ul>
</li>
<li><a href="#get_template_by_name">get_template_by_name</a></li>
</ul>
</li>
</ul>
</li>
<li><a href="#cherry-widget-factory">Cherry Widget Factory</a><ul>
<li><a href="#general-description_3">General Description</a></li>
<li><a href="#cherry_abstract_widget">Cherry_Abstract_Widget</a><ul>
<li><a href="#__construct">__construct()</a></li>
<li><a href="#widget_start">widget_start</a></li>
<li><a href="#widget_end">widget_end</a></li>
<li><a href="#setup_widget_data">setup_widget_data</a></li>
<li><a href="#reset_widget_data">reset_widget_data</a></li>
</ul>
</li>
<li><a href="#module-arguments_3">Module arguments</a></li>
<li><a href="#available-hooks_1">Available Hooks</a><ul>
<li><a href="#actions_1">Actions</a></li>
</ul>
</li>
<li><a href="#filters_1">Filters</a></li>
</ul>
</li>
<li><a href="#cherry-toolkit">Cherry Toolkit</a><ul>
<li><a href="#methods">Methods</a><ul>
<li><a href="#get_arg">get_arg</a></li>
<li><a href="#get_class_instance">get_class_instance</a></li>
<li><a href="#render_view">render_view</a></li>
<li><a href="#remove_empty">remove_empty</a></li>
<li><a href="#remove_empty_check">remove_empty_check</a></li>
<li><a href="#join">join</a></li>
<li><a href="#leave_right_keys-remove_right_keys">leave_right_keys, remove_right_keys</a></li>
</ul>
</li>
</ul>
</li>
</ul>
</div>
<div class="docs-wrapper__item">
<h2 id="cherry-customizer">Cherry Customizer</h2>
<p><strong>Cherry Customizer</strong> - module that simplifies the working procedure with native <a href="https://developer.wordpress.org/themes/advanced-topics/customizer-api/">WordPress Customizer API</a> functionality.</p>
<p>Native Customizer API operates 4 major entities  - panel, section, settings, control. The module leaves 3 - panel, section, control.</p>
<h3 id="module-arguments">Module arguments</h3>
<ul>
<li><code>prefix</code> - unique prefix to prevent issues during adding sections, controls (theme slug or plugin slug)</li>
<li><code>capability</code> - user capabilities required for proper module work (default, <code>edit_theme_options</code>)</li>
<li><code>type</code> - <code>theme_mod</code> or <code>option</code> (default, <code>theme_mod</code>). This parameter defines how the settings will be stored in wp_options table: <ul>
<li><em>option</em> - settings will be available all the time, independently from the active theme (used for plugin settings)</li>
<li><em>theme_mod</em> - settings are available only when the current theme is active (used for theme settings)</li>
</ul>
</li>
<li><strong>options</strong> -  (controls) grouped by panels and/or sections.</li>
</ul>
<p><em>Initialization example:</em></p>
<pre><code>your_prefix_get_core()-&gt;init_module( 'cherry-customizer', array(
    'prefix'     =&gt; 'your_prefix',
    'capability' =&gt; 'edit_theme_options',
    'type'       =&gt; 'theme_mod',
    'options'    =&gt; array(),
) );
</code></pre>
<p>See in comments for the <a href="https://github.com/CherryFramework/cherry-framework/blob/master/modules/cherry-customizer/cherry-customizer.php#L116-L154">module</a>.</p>
<blockquote>
<p>Call initialization on hook <code>after_setup_theme</code> with priority not lower than 2 (10 recommended).</p>
</blockquote>
<h3 id="panels">Panels</h3>
<p>Top hierrarchy level. Registration:</p>
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
<li><code>unique_panel_ID</code></li>
<li><code>title</code></li>
<li><code>description</code></li>
<li><code>priority</code> - priority affects on order. Default sections priority added from the core - <a href="https://developer.wordpress.org/themes/advanced-topics/customizer-api/#sections">https://developer.wordpress.org/themes/advanced-topics/customizer-api/#sections</a></li>
<li><code>capability</code> - if other capabilities are required </li>
<li><code>active_callback</code> - callback-function, defines when to display the panel</li>
</ul>
<blockquote>
<p>Panel can contain sections only.</p>
</blockquote>
<h3 id="sections">Sections</h3>
<p>Can be both top and intermedate level between panels and controls. Registration:</p>
<pre><code>'unique_section_ID' =&gt; array(
    'title'       =&gt; esc_html__( 'Section Title', 'text-domain' ),
    'description' =&gt; esc_html__( 'Section Description', 'text-domain' ),
    'priority'    =&gt; 10, (10, 20, 30, ...)
    'panel'       =&gt; 'unique_panel_ID', (*)
),
</code></pre>
<ul>
<li><code>unique_section_ID</code></li>
<li><code>title</code></li>
<li><code>description</code></li>
<li><code>priority</code> - priority (depands on order)</li>
<li><code>panel</code> - parent Panel ID</li>
</ul>
<blockquote>
<p>Panels and sections can be registered on the same level.
Section contains controls only.</p>
</blockquote>
<h3 id="controls">Controls</h3>
<p>Entity that is an option. Registration:</p>
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
<li><code>unique_control_ID</code></li>
<li><code>title</code></li>
<li><code>description</code></li>
<li><code>section</code> - parent Section ID</li>
<li><code>default</code> - default value</li>
<li><code>field</code> - control type </li>
<li><code>choise</code> -  select, radio controls value variants</li>
<li><code>active_callback</code> - callback-function, defines when to show the control </li>
<li><code>transport</code> - refresh or postMessage (value process type)</li>
<li><code>sanitize_callback</code> - custom function for value validation before saving to the database</li>
</ul>
<blockquote>
<p>Control can locate in section only.</p>
</blockquote>
<h4 id="control-types">Control Types</h4>
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
<li>fonts - fonts list (system and Google Web fonts)</li>
<li>radio</li>
<li>hex_color</li>
<li>image</li>
<li>file</li>
<li>iconpicker - for icon picking</li>
</ul>
</div>
<div class="docs-wrapper__item">
<h2 id="cherry-handler">Cherry Handler</h2>
<h3 id="description">Description</h3>
<p>Cherry-handler is designed for AJAX queries creation and managing. Automates process with nonce check, user role (capability), public AJAX. Also allows to send data for server processing and receive them back.</p>
<h3 id="sample-creation">Sample creation</h3>
<p>Every module initialization call creates its query with preset parameters. Operation procedure can be divided into 2 parts:</p>
<ul>
<li>query initialization (registration). This part is carried out on the back-end</li>
<li>instance initialization in public front-end or admin front-end js scripts</li>
</ul>
<h3 id="back-end-initialization">Back-end initialization</h3>
<p>Handler parameters:</p>
<ul>
<li><code>id</code> - unique handler ID (AJAX query). To avoid problems use various prefixes and numbers during generating the IDs. ID is used for binding back-end and front-end handlers</li>
<li><code>action</code> - wp-action name, handler creates an action by adding <code>wp_ajax_</code> and <code>wp_ajax_nopriv_</code> for the set name. Action name can be the same with ID. Action value is used for generating unique nonce</li>
<li><code>capability</code> - <a href="https://codex.wordpress.org/Roles_and_Capabilities">user role</a> wrapper for current_user_can() wp function</li>
<li><code>is_public</code> - defines whether to create an action with <code>wp_ajax_nopriv_</code>  prefix for  public front-end (false by default)</li>
<li><code>callback</code> - function that can be done after all checks. The callback can return void result. It can be done via echo or return, but the answer will be generated in json format. The result is located in Data property.</li>
<li><code>type</code> - query type (post by default)</li>
<li><code>sys_messages</code> - system messages array<ul>
<li><code>invalid_base_data</code> - server error or nonce field is empty</li>
<li><code>no_right</code> - no user right</li>
<li><code>invalid_nonce</code> - nonce validation error</li>
<li><code>access_is_allowed</code> - access is allowed</li>
<li><code>wait_processing</code> - previous query processing message</li>
</ul>
</li>
</ul>
<p>Initialization example:</p>
<pre><code>$sys_messages = array(
    'invalid_base_data' =&gt; esc_html__( 'Unable to process the request without nonche or server error', 'text-domain' ),
    'no_right'          =&gt; esc_html__( 'No right for this action', 'text-domain' ),
    'invalid_nonce'     =&gt; esc_html__( 'Stop CHEATING!!!', 'text-domain' ),
    'access_is_allowed' =&gt; esc_html__( 'Access is allowed','text-domain' ),
    'wait_processing'   =&gt; esc_html__( 'Please wait, processing the previous request', 'text-domain' ),
);

$options_ajax_handler = get_core()-&gt;init_module(
    'cherry-handler', array(
        'id'           =&gt; 'cherry_save_options_ajax',
        'action'       =&gt; 'cherry_save_options_ajax',
        'capability'   =&gt; 'manage_options',
        'callback'     =&gt; array( $this , 'cherry_save_options' ),
        'sys_messages' =&gt; $sys_messages,
        )
);
</code></pre>
<blockquote>
<p>Note:  If you set an empty line in a message, the notice will not be displayed. For example: If you don’t need an "Access is allowed" message, leave this field empty during handler initialization.</p>
</blockquote>
<h3 id="front-end-initialization">Front-end initialization</h3>
<p>Initialization example:</p>
<pre><code>saveOptionsInstance = new CherryJsCore.CherryAjaxHandler( /* object with parameters */ );
</code></pre>
<p>If CherryAjaxHandler is <strong>unavailable</strong>, handler can be initialized with <strong>CherryHandlerInit</strong> event:</p>
<pre><code>$( document ).on( 'CherryHandlerInit', this.init );
</code></pre>
<p>Or add <em>cherry-handler-js</em> when adding your script in dependencies:</p>
<pre><code>wp_enqueue_script(
    'your-script-handle',
    get_template_directory_uri() . '/assets/admin/js/script.js',
    array( 'cherry-js-core, cherry-handler-js' ),
    1.0.0,
    true
);
</code></pre>
<p>Handler js parameters:</p>
<ul>
<li><code>handlerId</code> - when checking the global area of js variables, you will see a variable with the name you’ve set during initializing the handler to a back-end.</li>
<li><code>cache</code> -  if set to false the browser will not cache the query. It will also add the line <code>_=[TIMESTAMP]</code> в URL. (false by default) </li>
<li><code>processData</code> - by default all send to server data will be transformed into line in url-format (<code>fName1=value1&amp;fName2=value2&amp;...</code>) relevant to <code>application/x-www-form-urlencoded</code>.  If you need to send data that can’t be processed in the mentioned way (for example DOM-document), you should disable processData option. (true by default)</li>
<li><code>url</code> - this parameter automatically defines the module, but you can set it manually  </li>
<li><code>beforeSendCallback</code> - custom-function on ajax before send request</li>
<li><code>errorCallback</code> - custom-function on ajax error event</li>
<li><code>successCallback</code> - custom-function on  ajax success event</li>
<li><code>completeCallback</code> - custom-function on  ajax complete event</li>
</ul>
<p>After js handler initialization the following methods are available:</p>
<ul>
<li><code>send</code> - formats AJAX query after all necessary checks. Each query processing stage comes with system messages. Launch method in any event whether it is click or scroll, for instance:</li>
<li><code>sendData</code> -  formats AJAX query and sets data in your custom callback. Wrapping-function for send methods<ul>
<li><code>data</code> - data for sending</li>
</ul>
</li>
<li><code>sendFormData</code> - signs  the form and sends to your custom callback<ul>
<li><code>formId</code> - unique form ID (form tag attribute)</li>
</ul>
</li>
</ul>
<p>Example:</p>
<pre><code>( function( $, CherryJsCore ) {
    'use strict';
    CherryJsCore.utilites.namespace('cherryPopupsBackScripts');
    CherryJsCore.cherryPopupsBackScripts = {
        saveHandlerId: 'cherry_save_options_ajax',
        setAsDefaultHandlerId: 'cherry_set_as_default_options_ajax',
        resetHandlerId: 'cherry_restore_options_ajax',
        saveButtonId: '#cherry-popups-save-options',
        resetButtonId: '#cherry-popups-restore-options',
        formId: '#cherry-popups-options-form',
        saveOptionsInstance: null,
        resetOptionsInstance: null,
        cherryHadlerInit: function () {
            // Add function to the event CherryHandlerInit
            $( document ).on( 'CherryHandlerInit', this.init.bind( this ) );
        },
        init: function () {
            // Initialize handlers here, set unique id and necessary callbacks
            this.saveOptionsInstance = new CherryJsCore.CherryAjaxHandler({
                handlerId: this.saveHandlerId,
                successCallback: this.saveSuccessCallback.bind( this )
            });
            this.resetOptionsInstance = new CherryJsCore.CherryAjaxHandler({
                handlerId: this.resetHandlerId,
                successCallback: this.restoreSuccessCallback.bind( this )
            });
            this.addEvents();
        },
        addEvents: function () {
            $( 'body' )
                .on( 'click', this.saveButtonId, this.saveOptionsHandler.bind( this ) )
                .on( 'click', this.resetButtonId, this.resetOptionsHandler.bind( this ) );
        },
        saveOptionsHandler: function( event ) {
            // Call method  sendFormData of the sample saveOptionsInstance, initialized above
            this.saveOptionsInstance.sendFormData( this.formId );
        },
        resetOptionsHandler: function( event ) {
            // Call method send of the sample resetOptionsInstance, initialized above
            this.resetOptionsInstance.send();
        },
        saveSuccessCallback: function() {
            CherryJsCore.cherryHandlerUtils.noticeCreate( 'success-notice', cherryPopupnSettings.save_message );
        },
        restoreSuccessCallback: function() {
            CherryJsCore.cherryHandlerUtils.noticeCreate( 'success-notice', cherryPopupnSettings.restore_message );
                setTimeout( function() {
                window.location.href = cherryPopupnSettings.redirect_url;
            }, 500 );
        }
    }

    CherryJsCore.cherryPopupsBackScripts.cherryHadlerInit();

} ( jQuery, window.CherryJsCore ) );
</code></pre>
<p>Data sent to the custom callback are available in the global array with "data" clue.</p>
<pre><code>if ( ! empty( $_REQUEST['data'] ) ) {
    $data = $_REQUEST['data'];
}
</code></pre>
<h3 id="display-system-messages">Display system messages</h3>
<p>The module allows to display system messages on the admin front-end, for that you need to call js method:</p>
<pre><code>CherryJsCore.cherryHandlerUtils.noticeCreate( 'success-notice', 'Save options' );
</code></pre>
<p><code>noticeCreate</code> method takes parameters:</p>
<ul>
<li><code>type</code> -  message type (success-notice, info-notice, error-notice) success-notice by default</li>
<li><code>message</code> - message text</li>
</ul>
<p>Example:</p>
<!-- ![Example](http://products.git.devoffice.com/cherry/docs-markdown/raw/edd522ef9767b20c12cd06dfe6672a73f632ad42/attachments/13205831.png) -->


</div>
<div class="docs-wrapper__item">
<h2 id="cherry-dynamic-css">Cherry Dynamic CSS</h2>
<h3 id="general-description">General Description</h3>
<p>Parses transferred CSS files and changes fond dynamic variables and functions to the proper values. Parsed CSS is added to the style tag in the site head. </p>
<p><strong>Variables</strong> set in <code>$name</code>-variable format. Variable can be an array. In this case value of any of the elements of this array can be received by a key on the same method as in PHP - <code>$variable_name[key]</code>. If it is necessary to add measurement units, they should be wrapped into the curly brackets - <code>$variable{px}</code>  - in this way the parser won't see the units as a part of variable. </p>
<p><strong>Functions</strong> are set in  <code>@function_name()</code> format. Full functions list and adding new functions algorithm is the following. </p>
<h3 id="module-arguments_1">Module Arguments</h3>
<p>The module can take arguments array with the following keys:</p>
<ul>
<li><code>prefix</code> - <em>string</em> - theme name. If we use the module in the theme and a prefix for plugin options or a name of an option in which all available plugin options are stored.  </li>
<li><code>type</code> - <em>string</em> - type of usable options  (theme_mod or option)</li>
<li><code>single</code> - <em>boolean</em> - options storage type. If true - all options are stored as an array in a single database slot. In other case, each option is stored in a single slot. </li>
<li><code>css_files</code> - <em>array</em> - path array to CSS files which should be parsed </li>
<li><code>options</code> - <em>array</em> -  options array, options names are used as variables names. Options values are taken from the database automatically and substitute the corresponding variables</li>
</ul>
<h3 id="functions">Functions</h3>
<h4 id="available-functions">Available functions</h4>
<ul>
<li><code>darken( color, percent)</code> - make the passed color darker on a passed percent.</li>
<li><code>lighten( color, percent )</code> - make the passed color lighter on a passed percent. </li>
<li><code>contrast( base color, light, dark )</code> - choose contrast color for the base color from two passed colors. If the base color is dark  - the first passed color (light) will be returned . If the base color is dark -  the second passed color (dark) will be returned </li>
<li><code>alpha( color, transparency )</code> - adds transparency to the passed color. </li>
<li><code>background( selector, array_with_background_data )</code> - not used yet as it works with data format on Cherry4</li>
<li><code>typography</code> - not used yet as it works with data format on Cherry4</li>
<li><code>box</code> - not used yet as it works with data format on Cherry4 </li>
<li><code>emph( selector, color, property)</code> - adds passed color to the passed property and generates a selector with hover which is 10% darker </li>
<li><code>font_size( size, operation, rounding, percent)</code> - changes passed size on a passed percent with the help of passed operation (multiple addition). The result is rounded with the help of  passed function  (floor, ceil, round, abs)</li>
<li><code>container_compare( container_width, element_width )</code> - compares container width value with the element value. If the element width is less it remains unchanged. If more, container width is returned.</li>
<li><code>sum( value1, value2 )</code> - sums up value1 and value2 </li>
<li><code>diff( value1, value2 )</code> - subtracts value2 from value1  </li>
<li><code>menu_toogle_endpoint</code> - not used yet as it works with data format on Cherry4</li>
</ul>
<h4 id="user-function-addition">User function addition</h4>
<p>User functions can be added to the module. <code>cherry_css_func_list</code> filter is used for that. Filter takes array of available function names, and callbacks for their processing, as an argument.  To add a new function, you need to add a new key-value pair to this array with the help of the filter. Key is a new function name and value -  callback name for this function.</p>
<h3 id="available-hooks">Available hooks</h3>
<h4 id="actions">Actions</h4>
<p><code>cherry_dynamic_css_include_custom_files</code></p>
<p>Arguments:</p>
<ul>
<li><code>$this-&gt;args</code> - global module arguments</li>
<li><code>$this-&gt;core</code> - core sample for the given module.</li>
</ul>
<p>Called in <code>print_inline_css()</code> method. With the help of this hook you can pass your CSS for processing by the given module sample. The given CSS will be added after the main one.</p>
<h4 id="filters">Filters</h4>
<p><code>cherry_css_var_list</code></p>
<p>Arguments:</p>
<ul>
<li><code>$var_list</code> - indexed array with the list of available variables of the given module sample (taken from the arguments)</li>
<li><code>$this-&gt;args</code> - global module arguments. With the help of this filter you can change an array of variables available for processing in the given module sample. Changes the list of available variables list only.</li>
</ul>
<p><code>cherry_css_variables</code></p>
<p>Arguments:</p>
<ul>
<li><code>$variables</code> - associative array (variable_name =&gt; variable_value)</li>
<li><code>$this-&gt;args</code> - global module arguments. This filter allows to change the list of available module variables and their value.</li>
</ul>
<p><code>cherry_css_func_list</code></p>
<p>Arguments:</p>
<ul>
<li><code>$func_list</code> - associative array with the list of available functions  (function_name =&gt; callbacks)</li>
<li><code>$this-&gt;args</code> - global module arguments. This filter allows to change the effect of current function on parser or add new functions.</li>
</ul>
<p><code>cherry_dynamic_css_parsed_styles</code></p>
<p>Arguments:</p>
<ul>
<li><code>$parsed_css</code> - string with processed CSS (without wrapping style tags)</li>
<li><code>$this-&gt;args</code> - global module arguments. The filter allows change/add processed CSS before displaying it on the page.</li>
</ul>
<h3 id="adding-inline-styles">Adding inline styles</h3>
<p>The module allows to generate inline styles and add them to the <code>&lt;head&gt;</code>. In this way, multiple <code>&lt;style&gt;</code> tags are deleted from DOM.</p>
<p>First of all, initialize the module and place instance into the variable:</p>
<pre><code>$this-&gt;dynamic_css = $this-&gt;get_core()-&gt;init_module( 'cherry-dynamic-css', array() );
</code></pre>
<p>after that <code>add_style</code> method is available. The method takes 3 parameters:</p>
<ul>
<li><code>selector</code> - css selector</li>
<li><code>style</code> - styles array, where key is css attribute and value - css value.  </li>
<li><code>media</code> - array which consists of 2 keys, <code>min =&gt; min-width</code>, <code>max =&gt; max-width</code>, in this way you can set css media breakpoints</li>
</ul>
<p>Example:</p>
<pre><code>$this-&gt;dynamic_css-&gt;add_style(
    '#your-selector',
    array(
        'width'  =&gt; '100%',
        'height' =&gt; 'auto',
    ),
    array(
        'min' =&gt; '320px',
        'max' =&gt; '989px',
    )
);
</code></pre>
</div>
<div class="docs-wrapper__item">
<h2 id="cherry-js-core">Cherry JS Core</h2>
<h3 id="general-description_1">General description</h3>
<p>The module is used for:</p>
<ol>
<li>General organization of JS-scripts structure </li>
<li>JS-utilities realization </li>
<li>Formation of the general <code>CherryJsCore</code> object for JS-project. The object is located in the global scope and contains data about project scripts and other issues </li>
<li>For PHP and JS interaction realization</li>
</ol>
<p>The module is divided to PHP and JS parts. PHP-file is singletone-calss which creates a single instance per project. PHP is mainly used for PHP and JS interaction realization via data localization (<code>wp_localize_script</code>) from wp-admin. In the main PHP file, you also need to add necessary assets. JS processes received from wp-admin data and contains abstract utilities and  expressions general for the entire project.</p>
<h3 id="main-js-object-structure-description">Main JS object structure description</h3>
<pre><code>name : 'Cherry Js Core', // module name
version : '1.0.0', // module version
author : 'Cherry Team', // module author
variable : { // general module variables
    $document : $( document ), // variable with link on document object, which returned jq-selector
    $window : $( window ), // variable with link on window object, which returned jq-selector
    browser : $.browser, // browser data
    browser_supported : true, // browser support
    security : cherry_ajax, // unique security key
    loaded_assets : { // list of loaded assets
        script : wp_load_script, // scripts list
        style : wp_load_style // styles list
    },
    ui_auto_init: ( 'true' == ui_init_object.auto_init ) ? true : false, //  ui-elements auto initialization
    ui_auto_target: ui_init_object.targets // target selectors where you need to carry out ui-elements auto-initialization
},
status : { // current sessions status
    on_load : false, // window load status
    is_ready : false // document readiness status
}
</code></pre>
<h4 id="expressions">Expressions</h4>
<ul>
<li><code>ui_init</code> - ui-elements initialization by target-selector. Selectors can be set via <code>cherry_core_js_ui_init_settings</code> filter in the array format. You can also state auto initialization status (default false)</li>
<li><code>widget_added_ui_init</code> - <em>widget-added</em> event initialization (add widget to the widget area event).  At the moment there is a <em>ui-elements</em> initialization trigger</li>
<li><code>widget_updated_ui_init</code> - <em>widget-added</em> event initialization (after save widget update event). At the moment there is a <em>ui-elements</em> initialization trigger</li>
</ul>
<h4 id="utilities">Utilities</h4>
<ul>
<li><code>namespace</code> - utility for creating name space inside the default <code>CherryJsCore</code></li>
<li><code>get_compress_assets</code></li>
</ul>
</div>
<div class="docs-wrapper__item">
<h2 id="cherry-template-manager">Cherry Template Manager</h2>
<h3 id="general-description_2">General Description</h3>
<p>The module allows to load and process template files (tmpl). In its turn, tmpl files contain html markup and macros which are replaced by content during files parsing. </p>
<p>tmpl-files load order is the following:</p>
<ol>
<li>folder - <em>wp-content</em> / <em>uploads</em> / <em>theme_name (plugin_name)</em> / <em>template-name.tmpl</em></li>
<li>folder in the theme - <em>wp-content</em> / <em>themes</em> / <em>theme_name</em> / <em>templates</em> / <em>theme_name (plugin_name)</em> / <em>template_name.tmpl</em></li>
<li>folder in the plugin - <em>wp-content</em> / <em>plugins</em> / <em>plugin_name</em> / <em>templates</em> / <em>theme_name (plugin_name)</em> / <em>template_name.tmpl</em></li>
</ol>
<h3 id="files-structure">Files structure</h3>
<p>tmpl-file can include any HTML markup and macros of two types.</p>
<p><strong>PHP code in tmpl-files will not work.</strong></p>
<p>Macros types:</p>
<ul>
<li><code>%%MACRO_NAME%%</code> - macro which calls the callback for processing </li>
<li><code>$$MACRO_NAME$$</code> - macro which receives variable value from variable attribute of the callbacks class.</li>
</ul>
<p>Example:</p>
<pre><code>&lt;button type="submit" class="search-submit btn btn-primary"&gt;
    %%ICON%%
    %%SUBMIT_TEXT%%
&lt;/button&gt;

&lt;span class="screen-reader-text"&gt;$$READER_TEXT$$&lt;/span&gt;
&lt;input type="search" class="search-field" placeholder="$$PLACEHOLDER$$" value="" name="s"&gt;
</code></pre>
<h3 id="module-arguments_2">Module arguments</h3>
<ul>
<li><code>template_dir</code> - <em>string</em> - path to template format. By default: <code>templates/%1$s/%2$s.tmpl</code></li>
<li><code>slug</code> - <em>string</em> - product slug (set automatically). By default: <code>''</code></li>
<li><code>upload_dir</code> - <em>string</em> - path to directory with uploads (set automatically). By default: <code>''</code></li>
<li><code>macros_callback</code> - <em>string</em> - regular expression for callback macro which is passed in the callbacks class. By default: <code>/%%.+?%%/</code></li>
<li><code>macros_variable</code> - <em>string</em> - variable macro regular expression which is passed in the callbacks class. By default: <code>/\$\$.+?\$\$/</code></li>
</ul>
<h3 id="module-methods">Module methods</h3>
<h4 id="parsed_template">parsed_template</h4>
<p>The method loads tmpl-files and parses callbacks and variables macros, replacing them with their results. The method returns HTML.  </p>
<ul>
<li><code>template_name</code> - <em>string</em> - name of the loaded template (without *.tmpl extension). Example: <em>search-form</em>. By default: <strong>false</strong></li>
<li><code>class</code> - <em>string</em> | <em>stdClass</em> - class name or sample. If class name is passed as string, method parsed_template tries to get its sample. If sample is passed, methods starts to work with it right away. All methods for callback macros should be public. Data for variables macro should be stored as an array inside $variables array of the passed class. The property should also be  public. By default: <strong>false</strong></li>
<li><code>macros_callback</code> - <em>string</em> - regular expression for callback macro, which is passed in callback class. the given argument is set individually and will be of the top priority, compared to the module <strong>macros_callback</strong> argument. By default: <strong>false</strong></li>
<li><code>macros_variable</code> - <em>string</em> - regular expression for variable macros, which is passed in callback class. The given argument is set individually  and will be of the top priority, compared to the module  <strong>macros_variable</strong> argument.  By default: <strong>false</strong></li>
</ul>
<p>Example:</p>
<pre><code>$template_manager = Cherry_Template_Manager::get_instance();

$template_manager-&gt;parser-&gt;parsed_template(
    'your-template-name',
    your_callback()
);
</code></pre>
<h5 id="callback-variables-filters">Callback &amp; variables filters</h5>
<p>You can rewrite or add new Callbacks and variables values. For that you can use 2 filters, one for variables and the second for callbacks.</p>
<p>They have the following formats:</p>
<ul>
<li>Variable - <code>{$product_slug}_set_variable_{$macro_name}</code>. In lower case. Example: <strong>cherry-search_set_variable_placeholder</strong>. The macro in tmpl-file looks like that - <code>$$PLACEHOLDER$$</code></li>
<li>Callback -  <code>{product_slug}_set_callback_{$macro_name}</code>. In lower case. Example: <strong>cherry-search_set_callback_submit_text</strong>. The macro in tmpl-file looks like that - <code>%%SUBMIT_TEXT%%</code></li>
</ul>
<h4 id="get_template_by_name">get_template_by_name</h4>
<p>The method loads tmpl-file content. Search result is returned with a string. If the template is not found, returns false value.</p>
<ul>
<li><code>name</code> - <em>string</em> - name of the loaded template (without *.tmpl extension). Example: <em>search-form-input</em>. By default: <code>false</code></li>
</ul>
<p>Example:</p>
<pre><code>$template_manager = Cherry_Template_Manager::get_instance();

$template_manager-&gt;loader-&gt;get_template_by_name( 'your-template-name' );
</code></pre>
</div>
<div class="docs-wrapper__item">
<h2 id="cherry-widget-factory">Cherry Widget Factory</h2>
<h3 id="general-description_3">General Description</h3>
<p>The module adds Cherry_Abstract_Widget class which allows you to create custom widgets. Besides adding an abstract widget, the base module class passes the current core sample to the widgets built on its base and calls automatic UI elements and widgets initialization.</p>
<h3 id="cherry_abstract_widget">Cherry_Abstract_Widget</h3>
<h4 id="__construct">__construct()</h4>
<p>Creating your widget based on <code>Cherry_Abstract_Widget</code> in constructor, you should claim several compulsory attributes. </p>
<ul>
<li><code>$this-&gt;widget_cssclass</code> - CSS class, which wll be added to the widget on the frontend. It is recommended to avoid underscores in titles as they will be cut.  </li>
<li><code>$this-&gt;widget_description</code> - widget description that will be displayed in the admin panel.</li>
<li><code>$this-&gt;widget_id</code> - base widget ID</li>
<li><code>$this-&gt;widget_name</code> - widget name that will be displayed in the admin panel.</li>
<li><code>$this-&gt;settings</code> - associative array with widget fields.</li>
</ul>
<p>Widget fileds example:</p>
<pre><code>'title'  =&gt; array(
    'type'  =&gt; 'text', // one of available UI element types
    'value' =&gt; default value,
    'label' =&gt; label for the field in the admin panel
</code></pre>
<p>Other fields that can be added to the array depend on the type of the element.</p>
<blockquote>
<p>If it is necessary to pass a set of dynamically generated data (list of categories, posts, tags, etc.) as an options array for any of the fields, it is better to use an <code>options_callback</code> attribute. In this attribute you need to pass a function that will return a necessary options array. It is done to make the dynamically generated options list work only during widget controlls form generating procedure.</p>
</blockquote>
<h4 id="widget_start">widget_start</h4>
<pre><code>widget_start( $args, $instance );
</code></pre>
<p>Method that displays widget header.</p>
<p>Arguments:</p>
<ul>
<li><code>$args</code> - widget common arguments array</li>
<li><code>$instance</code> - data array for the current widget sample</li>
</ul>
<h4 id="widget_end">widget_end</h4>
<pre><code>widget_end( $args );
</code></pre>
<p>Method that displays widget footer.</p>
<p>Arguments:</p>
<ul>
<li><code>$args</code> - array of widget general arguments</li>
</ul>
<h4 id="setup_widget_data">setup_widget_data</h4>
<pre><code>setup_widget_data( $args, $instance );
</code></pre>
<p>Method that should be preferably called at the beginning of <code>widget()</code>-method. It sets <code>$this-&gt;args</code> and <code>$this-instance</code> properties for using in any service methods. </p>
<h4 id="reset_widget_data">reset_widget_data</h4>
<pre><code>reset_widget_data();
</code></pre>
<p>Method which resets <code>$this-&gt;args</code> and <code>$this-instance</code>.</p>
<h3 id="module-arguments_3">Module arguments</h3>
<p>The module doesn't take any custom arguments, except for current core sample.</p>
<h3 id="available-hooks_1">Available Hooks</h3>
<h4 id="actions_1">Actions</h4>
<ul>
<li><code>cherry_widget_after_update</code> - $instance argument - data for the current widget sample. Hook that triggers after update of current widget sample</li>
<li><code>cherry_widget_factory_control</code> - $args argument - control arguments array. Hook that allows to add custom controls to the widget settings editing form</li>
<li><code>cherry_widget_reset_data</code> - hook which allows to perform additional operations while removing the current widget data  from the object cash</li>
</ul>
<h3 id="filters_1">Filters</h3>
<p>none</p>
</div>
<div class="docs-wrapper__item">
<h2 id="cherry-toolkit">Cherry Toolkit</h2>
<p>Cherry Toolkit module is designed for working inside the framework and contains (assistance) functions.</p>
<blockquote>
<p>The module should be installed by default</p>
</blockquote>
<h3 id="methods">Methods</h3>
<blockquote>
<p>This module should include static methods only</p>
</blockquote>
<h4 id="get_arg">get_arg</h4>
<pre><code>get_arg( $field, $arg, $default = '' );
</code></pre>
<p>Get argument from the array. In case the argument was not found, the $default parameter argument is used.</p>
<ul>
<li><code>$field</code> - <em>array</em> - Arguments array</li>
<li><code>$arg</code> - <em>string</em> | <em>int</em> | <em>float</em> - Arguments array key</li>
<li><code>$default</code> - <em>mixed</em> - Returned default argument, if an argument was not found in the array by transferred key <code>$arg</code></li>
</ul>
<h4 id="get_class_instance">get_class_instance</h4>
<pre><code>get_class_instance( $class_name = '', $core, $args );
</code></pre>
<p>Get new class entity. <strong>$core</strong> and <strong>$args</strong> are transferred to the class constructor as arguments.</p>
<ul>
<li><code>$class_name</code> - <em>string</em> - Class name</li>
<li><code>$core</code> - <em>Cherry_Core</em> - Cherry_Core entity</li>
<li><code>$args</code> - <em>array</em> - Additional constructor arguments</li>
</ul>
<h4 id="render_view">render_view</h4>
<pre><code>render_view( $path, array $data = array() );
</code></pre>
<p>Data transition to the loaded template file. Execution result - HTML code.</p>
<ul>
<li><code>$path</code> - <em>string</em> - Path to the template file</li>
<li><code>$data</code> - <em>array</em> - Array with variables and their arguments. Variables will be available in the template</li>
</ul>
<h4 id="remove_empty">remove_empty</h4>
<pre><code>remove_empty( $arr );
</code></pre>
<p>Empty elements remove.</p>
<ul>
<li><code>$arr</code> - <em>array</em> - Elements array</li>
</ul>
<h4 id="remove_empty_check">remove_empty_check</h4>
<pre><code>remove_empty_check( $var );
</code></pre>
<p>Function for variable empty value check.</p>
<ul>
<li><code>$var</code> -<em>mixed</em> - variable</li>
</ul>
<h4 id="join">join</h4>
<pre><code>join( $arr = array() );
</code></pre>
<p>Function which unites array elements into the attributes string.</p>
<ul>
<li><code>$arr</code> - <em>array</em> - Elements array</li>
</ul>
<h4 id="leave_right_keys-remove_right_keys">leave_right_keys, remove_right_keys</h4>
<pre><code>leave_right_keys( $right_keys, $array );
remove_right_keys( $right_keys, $array );
</code></pre>
<p>Function for working with arrays. Both functions check if the array elements are on the "blacklist" and delete them.</p>
</div>