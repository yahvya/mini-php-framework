<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* global.twig */
class __TwigTemplate_039636d61d77ba1233bcd36cfec52476 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'css' => [$this, 'block_css'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"fr\">
<head>
\t<meta charset=\"UTF-8\">
\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
\t<title>";
        // line 6
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
\t";
        // line 7
        $this->displayBlock('css', $context, $blocks);
        // line 8
        echo "</head>
<body>
\t";
        // line 10
        $this->displayBlock('body', $context, $blocks);
        // line 11
        echo "</body>
</html>";
    }

    // line 6
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Exemple";
    }

    // line 7
    public function block_css($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    // line 10
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    public function getTemplateName()
    {
        return "global.twig";
    }

    public function getDebugInfo()
    {
        return array (  77 => 10,  71 => 7,  64 => 6,  59 => 11,  57 => 10,  53 => 8,  51 => 7,  47 => 6,  40 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "global.twig", "/home/yahayab/Bureau/projets-web-apache/phpscratchproject/project/views/templates/global.twig");
    }
}
