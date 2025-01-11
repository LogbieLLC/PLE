<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* error.twig */
class __TwigTemplate_16497ef9345771222ae5c9b4006a213f extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<!DOCTYPE html>
<html>
<head>
    <title>PLE System - Error</title>
    <link rel=\"stylesheet\" href=\"/style.css\">
</head>
<body>
    <div class=\"container\">
        <header>
            <h1>Error</h1>
            <nav>
                <a href=\"index.php\" class=\"button\">Back to Home</a>
            </nav>
        </header>

        <main>
            <div class=\"error-message\">
                <h2>An error occurred</h2>
                <p>";
        // line 19
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["message"] ?? null), "html", null, true);
        yield "</p>
            </div>
        </main>
    </div>
</body>
</html>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "error.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  62 => 19,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html>
<head>
    <title>PLE System - Error</title>
    <link rel=\"stylesheet\" href=\"/style.css\">
</head>
<body>
    <div class=\"container\">
        <header>
            <h1>Error</h1>
            <nav>
                <a href=\"index.php\" class=\"button\">Back to Home</a>
            </nav>
        </header>

        <main>
            <div class=\"error-message\">
                <h2>An error occurred</h2>
                <p>{{ message }}</p>
            </div>
        </main>
    </div>
</body>
</html>
", "error.twig", "/home/ubuntu/repos/PLE/php-backend/templates/error.twig");
    }
}
