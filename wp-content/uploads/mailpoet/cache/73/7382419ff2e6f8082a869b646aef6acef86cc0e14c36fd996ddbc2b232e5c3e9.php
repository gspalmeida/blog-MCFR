<?php

/* form/templates/settings/values_item.hbs */
class __TwigTemplate_dcdf8972ae328a9a0fded7d8d612460cc9b115e8f88de854b001601473979e7e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<li class=\"clearfix\">
  {{#ifCond type 'in' 'radio,select'}}
    <input class=\"is_checked radio\" type=\"radio\" name=\"\"
    {{#if is_checked}}checked=\"checked\"{{/if}} value=\"1\"/>
  {{else}}
    <input class=\"is_checked checkbox\" type=\"checkbox\" name=\"\"
    {{#if is_checked}}checked=\"checked\"{{/if}} value=\"1\"/>
  {{/ifCond}}

    <input
      type=\"text\"
      name=\"\"
      class=\"value\"
      value=\"{{ value }}\"
      data-parsley-errors-messages-disabled=\"true\"
      data-parsley-required=\"true\"
    />

    {{#ifCond type 'in' 'radio,select'}}
      <a class=\"remove\" href=\"javascript:;\">";
        // line 20
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Remove");
        echo "</a>
    {{/ifCond}}
</li>";
    }

    public function getTemplateName()
    {
        return "form/templates/settings/values_item.hbs";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  40 => 20,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "form/templates/settings/values_item.hbs", "/var/www/html/blog.mcfr.com.br/wp-content/plugins/mailpoet/views/form/templates/settings/values_item.hbs");
    }
}
