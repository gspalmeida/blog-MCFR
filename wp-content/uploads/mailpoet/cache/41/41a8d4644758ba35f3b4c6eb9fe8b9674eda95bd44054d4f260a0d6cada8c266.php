<?php

/* help.html */
class __TwigTemplate_de0f168844cfbab5c80e3970b80039912c768fda9ef10decac1175756379bc90 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("layout.html", "help.html", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
            'translations' => array($this, 'block_translations'),
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
<h1 class=\"title\">";
        // line 5
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Help");
        echo "</h1>

<div id=\"mailpoet_help\">

  <script type=\"text/javascript\">
    var systemInfoData = ";
        // line 10
        echo json_encode(($context["systemInfoData"] ?? null));
        echo ";
    var systemStatusData = ";
        // line 11
        echo json_encode(($context["systemStatusData"] ?? null));
        echo ";
  </script>

  <div id=\"help_container\"></div>

</div>

";
    }

    // line 19
    public function block_translations($context, array $blocks = array())
    {
        // line 20
        echo $this->env->getExtension('MailPoet\Twig\I18n')->localize(array("tabKnowledgeBaseTitle" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Knowledge Base"), "tabSystemInfoTitle" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("System Info"), "tabSystemStatusTitle" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("System Status"), "systemStatusIntroCron" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("For the plugin to work, it must be able to establish connection with the task scheduler."), "systemStatusIntroCronMSS" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("For the plugin to work, it must be able to establish connection with the task scheduler and the key activation/MailPoet sending service."), "systemStatusCronTitle" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Task Scheduler"), "systemStatusMSSTitle" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Key Activation and MailPoet Sending Service"), "systemStatusConnectionSuccessful" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Connection successful."), "systemStatusConnectionUnsuccessful" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Connection unsuccessful."), "systemStatusCronConnectionUnsuccessfulInfo" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Please consult our [link]knowledge base article[/link] for troubleshooting tips."), "systemStatusMSSConnectionUnsuccessfulInfo" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Please contact our technical support for assistance."), "knowledgeBaseIntro" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Click on one of these categories below to find more information:"), "knowledgeBaseButton" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Visit our Knowledge Base for more articles"), "systemInfoIntro" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("The information below is useful when you need to get in touch with our support. Just copy all the text below and paste it into a message to us."), "systemInfoDataError" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Sorry, there was an error, please try again later."), "systemStatusCronStatusTitle" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Cron"), "systemStatusQueueTitle" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Sending Queue"), "lastUpdated" => $this->env->getExtension('MailPoet\Twig\I18n')->translateWithContext("Last updated", "A label in a status table e.g. Last updated: 2018-10-18 18:50"), "lastRunStarted" => $this->env->getExtension('MailPoet\Twig\I18n')->translateWithContext("Last run started", "A label in a status table e.g. Last run started: 2018-10-18 18:50"), "lastRunCompleted" => $this->env->getExtension('MailPoet\Twig\I18n')->translateWithContext("Last run completed", "A label in a status table e.g. Last run completed: 2018-10-18 18:50"), "lastSeenError" => $this->env->getExtension('MailPoet\Twig\I18n')->translateWithContext("Last seen error", "A label in a status table e.g. Last seen error: Process timeout"), "unknown" => $this->env->getExtension('MailPoet\Twig\I18n')->translateWithContext("unknown", "An unknown state is a status table e.g. Last run started: unknown"), "accessible" => $this->env->getExtension('MailPoet\Twig\I18n')->translateWithContext("Accessible", "A label in a status table e.g. Accessible: yes"), "status" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Status"), "yes" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("yes"), "no" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("no"), "none" => $this->env->getExtension('MailPoet\Twig\I18n')->translateWithContext("none", "An empty state is a status table e.g. Error: none"), "running" => $this->env->getExtension('MailPoet\Twig\I18n')->translateWithContext("running", "A state of a process."), "paused" => $this->env->getExtension('MailPoet\Twig\I18n')->translateWithContext("paused", "A state of a process."), "cronWaiting" => $this->env->getExtension('MailPoet\Twig\I18n')->translateWithContext("waiting for the next run", "A state of a process."), "startedAt" => $this->env->getExtension('MailPoet\Twig\I18n')->translateWithContext("Started at", "A label in a status table e.g. Started at: 2018-10-18 18:50"), "sentEmails" => $this->env->getExtension('MailPoet\Twig\I18n')->translateWithContext("Sent emails", "A label in a status table e.g. Sent emails: 50"), "retryAttempt" => $this->env->getExtension('MailPoet\Twig\I18n')->translateWithContext("Retry attempt", "A label in a status table e.g. Retry attempt: 2"), "retryAt" => $this->env->getExtension('MailPoet\Twig\I18n')->translateWithContext("Retry at", "A label in a status table e.g. Retry at: 2018-10-18 18:50"), "error" => $this->env->getExtension('MailPoet\Twig\I18n')->translateWithContext("Error", "A label in a status table e.g. Error: missing data"), "totalCompletedTasks" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Total completed tasks"), "totalScheduledTasks" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Total scheduled tasks"), "totalRunningTasks" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Total running tasks"), "totalPausedTasks" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Total paused tasks"), "scheduledTasks" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Scheduled tasks"), "runningTasks" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Running tasks"), "completedTasks" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Completed tasks"), "type" => $this->env->getExtension('MailPoet\Twig\I18n')->translateWithContext("Type", "Table column heading for task type."), "email" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Email"), "priority" => $this->env->getExtension('MailPoet\Twig\I18n')->translateWithContext("Priority", "Table column heading for task priority (number)."), "scheduledAt" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Scheduled At"), "updatedAt" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Updated At"), "nothingToShow" => $this->env->getExtension('MailPoet\Twig\I18n')->translate("Nothing to show."), "preview" => $this->env->getExtension('MailPoet\Twig\I18n')->translateWithContext("Preview", "Text of a link to email preview page.")));
        // line 70
        echo "
";
    }

    public function getTemplateName()
    {
        return "help.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  64 => 70,  62 => 20,  59 => 19,  47 => 11,  43 => 10,  35 => 5,  32 => 4,  29 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "help.html", "/var/www/html/blog.mcfr.com.br/wp-content/plugins/mailpoet/views/help.html");
    }
}
