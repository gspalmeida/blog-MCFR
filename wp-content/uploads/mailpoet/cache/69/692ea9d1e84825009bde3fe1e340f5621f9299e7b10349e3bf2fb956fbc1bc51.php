<?php

/* premium.html */
class __TwigTemplate_5823d20d3e1aa41b3a289e2c61f9c9c2dba10dd195f94fe2d9d06e8026197c8d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("layout.html", "premium.html", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
            'after_javascript' => array($this, 'block_after_javascript'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "
<div class=\"wrap mailpoet-about-wrap\">
  <h1 style=\"text-align: center; margin-right: 0;\">";
        // line 6
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("What is MailPoet Premium?");
        echo "</h1>

  <p class=\"about-text\" style=\"text-align: center; margin-right: 0;\">";
        // line 8
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Check out the brief video below. Or, keep reading!");
        echo "</p>

  <hr>

  <div class=\"headline-feature feature-video\">
    <div class=\"videoWrapper\">
      <iframe src=\"https://player.vimeo.com/video/225337083\" width=\"1050\" height=\"591\" frameborder=\"0\" webkitallowfullscreen=\"\" mozallowfullscreen=\"\" allowfullscreen=\"\"></iframe>
    </div>
  </div>

  <hr>

  <h2>";
        // line 20
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Insightful Statistics");
        echo "</h2>

  <div class=\"feature-section one-col\">
    <p class=\"lead-description\">";
        // line 23
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Which links get the most clicks? Which subscribers opened your emails? With MailPoet's stats program, it's easy to find out. Need even more details? Integrating with Google Analytics is as easy as 1-2-3.");
        echo "</p>
    ";
        // line 24
        $context["video_url"] = "//ps.w.org/mailpoet/assets/premium/premium-page-animated-stats.mp4";
        // line 25
        echo "    <video autoplay loop width=\"100%\" class=\"mailpoet_video\">
      <source type=\"video/mp4\" src=\"";
        // line 26
        echo twig_escape_filter($this->env, ($context["video_url"] ?? null), "html", null, true);
        echo "\" />
      <a href=\"";
        // line 27
        echo twig_escape_filter($this->env, ($context["video_url"] ?? null), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, ($context["video_url"] ?? null), "html", null, true);
        echo "</a>
    </video>
  </div>

  <hr>

  <h2>";
        // line 33
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Hello Inbox, Goodbye Spambox!");
        echo "</h2>

  <div class=\"feature-section one-col\">
    <p class=\"lead-description\">";
        // line 36
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Having issues with reaching your subscribers? Always ending up in the spam box? Don't panic! You're not alone - over a quarter of our plugin users have sending issues, usually because they are sending emails via their web host. Instead, try using the new MailPoet Sending Service.");
        echo "</p>
    <table class=\"widefat\">
      <thead>
        <tr>
         <td></td>
         <td><strong>";
        // line 41
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("MailPoet");
        echo "</strong></td>
         <td><strong>";
        // line 42
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Web host");
        echo "</strong></td>
         <td><strong>";
        // line 43
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Third party");
        echo "</strong></td>
        </tr>
      </thead>
      <tbody>
        <tr class=\"alternate\">
         <td><strong>";
        // line 48
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Speed");
        echo "</strong></td>
         <td>";
        // line 49
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("50,000 / hour");
        echo "</td>
         <td>";
        // line 50
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("300 / hour");
        echo "</td>
         <td>";
        // line 51
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("2,000 / hour");
        echo "</td>
        </tr>
        <tr>
         <td><strong>";
        // line 54
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Daily email limits");
        echo "</strong></td>
         <td>";
        // line 55
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("None");
        echo "</td>
         <td>";
        // line 56
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Yes");
        echo "</td>
         <td>";
        // line 57
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Depends");
        echo "</td>
        </tr>
        <tr class=\"alternate\">
         <td><strong>";
        // line 60
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Personal deliverability support");
        echo "</strong></td>
         <td>";
        // line 61
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Yes!");
        echo "</td>
         <td>";
        // line 62
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("No");
        echo "</td>
         <td>";
        // line 63
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("No");
        echo "</td>
        </tr>
        <tr>
         <td><strong>";
        // line 66
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("SPF and DKIM Signatures");
        echo "</strong></td>
         <td>";
        // line 67
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("No need!");
        echo "</td>
         <td>";
        // line 68
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Update your DNS");
        echo "</td>
         <td>";
        // line 69
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Depends");
        echo "</td>
        </tr>
        <tr class=\"alternate\">
         <td><strong>";
        // line 72
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Double opt-in");
        echo "</strong></td>
         <td>";
        // line 73
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Enforced");
        echo "</td>
         <td>";
        // line 74
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Not enforced");
        echo "</td>
         <td>";
        // line 75
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Depends");
        echo "</td>
        </tr>
        <tr>
          <td colspan=\"4\">
            <div style=\"text-align: center\">
              <a
                href=\"http://beta.docs.mailpoet.com/article/181-comparison-table-of-sending-methods?utm_source=plugin&utm_medium=premium&utm_campaign=compare\"
                target=\"_blank\"
              >
                ";
        // line 84
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("View full comparison table");
        echo "
              </a>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <p>";
        // line 91
        echo MailPoet\Util\Helpers::replaceLinkTags($this->env->getExtension('MailPoet\Twig\I18n')->translate("Spammers are ineligible to use the MailPoet Sending Service. We reserve the right to cancel any sending plan if we detect more than 5% hard bounces. [link]Customers are required to clean their lists before joining MailPoet[/link]."), "http://beta.docs.mailpoet.com/article/127-checklist-before-importing-subscribers?utm_source=plugin&utm_medium=premium&utm_campaign=clean-lists", array("target" => "_blank"));
        // line 94
        echo "</p>
  </div>

  <hr>

  <div class=\"feature-section two-col\">
    <div class=\"col\">
      <h3>";
        // line 101
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Welcome to My Newsletter!");
        echo "</h3>
      ";
        // line 102
        $context["video_url"] = "//ps.w.org/mailpoet/assets/premium/premium-page-animated-welcome-emails.mp4";
        // line 103
        echo "      <video autoplay loop width=\"100%\" class=\"mailpoet_video\">
        <source type=\"video/mp4\" src=\"";
        // line 104
        echo twig_escape_filter($this->env, ($context["video_url"] ?? null), "html", null, true);
        echo "\" />
        <a href=\"";
        // line 105
        echo twig_escape_filter($this->env, ($context["video_url"] ?? null), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, ($context["video_url"] ?? null), "html", null, true);
        echo "</a>
      </video>
      <p>";
        // line 107
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Want to send autoresponders and welcome emails to your subscribers? In MailPoet, it’s easy as 1-2-3. Create welcome emails, educational courses, and other automatic email newsletters.");
        echo "</p>
    </div>
    <div class=\"col\">
      <h3>";
        // line 110
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("We’re Here to Help!");
        echo "</h3>
      ";
        // line 111
        $context["video_url"] = "//ps.w.org/mailpoet/assets/premium/premium-page-animated-support.mp4";
        // line 112
        echo "      <video autoplay loop width=\"100%\" class=\"mailpoet_video\">
        <source type=\"video/mp4\" src=\"";
        // line 113
        echo twig_escape_filter($this->env, ($context["video_url"] ?? null), "html", null, true);
        echo "\" />
        <a href=\"";
        // line 114
        echo twig_escape_filter($this->env, ($context["video_url"] ?? null), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, ($context["video_url"] ?? null), "html", null, true);
        echo "</a>
      </video>
      <p>";
        // line 116
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("We pride ourselves on giving nearly round-the-clock support. Our remote team spans several continents, hemispheres, and time-zones! If you’ve got a problem, we will help you fix it!");
        echo "</p>
    </div>
  </div>

  <hr>

  <h2>";
        // line 122
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Get Started for Just \$10");
        echo "</h2>

  <div class=\"feature-section one-col\">
    <p class=\"lead-description\">";
        // line 125
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Our plans start at just \$10 per month. Plus, if you pay annually, you’ll get two months for free!");
        echo "</p>
    <br>
    <p style=\"text-align: center\">
      <a
        target=\"_blank\"
        href=\"https://account.mailpoet.com?s=";
        // line 130
        echo twig_escape_filter($this->env, ($context["subscriber_count"] ?? null), "html", null, true);
        echo "&utm_source=plugin&utm_medium=premium&utm_campaign=purchase\"
        class=\"button button-primary\"
        style=\"font-size: 1.5em; padding: 10px 18px; height: 46px;\"
      >";
        // line 133
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Purchase Now");
        echo "</a>
    </p>
    <br>
    <div style=\"width: 65%; margin: 0 auto;\">
      <p style=\"text-align: center\">";
        // line 137
        echo MailPoet\Util\Helpers::replaceLinkTags($this->env->getExtension('MailPoet\Twig\I18n')->translate("Already a Premium customer? [link]Add your Key in the Settings page[/link]."), admin_url("admin.php?page=mailpoet-settings#premium"), array("target" => "_blank"));
        // line 140
        echo "</p>
      <p style=\"text-align: center\">";
        // line 141
        echo MailPoet\Util\Helpers::replaceLinkTags($this->env->getExtension('MailPoet\Twig\I18n')->translate("Don't need to use our sending service? Not a problem; we understand. You can also [link]buy the Premium[/link] features separately. Prices start at \$100 per year for 1 website, \$249 for 4 sites and \$499 for an unlimited number of sites."), "https://account.mailpoet.com/premium?utm_source=plugin&utm_medium=premium&utm_campaign=buy-premium", array("target" => "_blank"));
        // line 144
        echo "</p>
    </div>
  </div>

</div>

";
    }

    // line 152
    public function block_after_javascript($context, array $blocks = array())
    {
        // line 153
        echo "<script type=\"text/javascript\">
  MailPoet.trackEvent('Premium page viewed', {
    'MailPoet Free version': window.mailpoet_version
  });
</script>
";
    }

    public function getTemplateName()
    {
        return "premium.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  335 => 153,  332 => 152,  322 => 144,  320 => 141,  317 => 140,  315 => 137,  308 => 133,  302 => 130,  294 => 125,  288 => 122,  279 => 116,  272 => 114,  268 => 113,  265 => 112,  263 => 111,  259 => 110,  253 => 107,  246 => 105,  242 => 104,  239 => 103,  237 => 102,  233 => 101,  224 => 94,  222 => 91,  212 => 84,  200 => 75,  196 => 74,  192 => 73,  188 => 72,  182 => 69,  178 => 68,  174 => 67,  170 => 66,  164 => 63,  160 => 62,  156 => 61,  152 => 60,  146 => 57,  142 => 56,  138 => 55,  134 => 54,  128 => 51,  124 => 50,  120 => 49,  116 => 48,  108 => 43,  104 => 42,  100 => 41,  92 => 36,  86 => 33,  75 => 27,  71 => 26,  68 => 25,  66 => 24,  62 => 23,  56 => 20,  41 => 8,  36 => 6,  32 => 4,  29 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "premium.html", "/var/www/html/blog.mcfr.com.br/wp-content/plugins/mailpoet/views/premium.html");
    }
}
