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

/* login.twig */
class __TwigTemplate_ddd98891dbdfd2a9752a74a254f54e89 extends Template
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
    <title>PLE System - Login</title>
    <link rel=\"stylesheet\" href=\"/style.css\">
</head>
<body>
    <div class=\"container\">
        <header>
            <h1>PLE System Login</h1>
        </header>

        <main>
            <div class=\"login-form\">
                ";
        // line 15
        if (($context["error"] ?? null)) {
            // line 16
            yield "                    <div class=\"error-message\">
                        ";
            // line 17
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["error"] ?? null), "html", null, true);
            yield "
                    </div>
                ";
        }
        // line 20
        yield "
                <form method=\"POST\" action=\"index.php?action=login\">
                    <div class=\"form-group\">
                        <label for=\"username\">Username:</label>
                        <input type=\"text\" name=\"username\" id=\"username\" required>
                    </div>

                    <div class=\"form-group\">
                        <label for=\"password\">Password:</label>
                        <input type=\"password\" name=\"password\" id=\"password\" required>
                    </div>

                    <button type=\"submit\" class=\"button-primary\">Login</button>
                </form>
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
        return "login.twig";
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
        return array (  69 => 20,  63 => 17,  60 => 16,  58 => 15,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html>
<head>
    <title>PLE System - Login</title>
    <link rel=\"stylesheet\" href=\"/style.css\">
</head>
<body>
    <div class=\"container\">
        <header>
            <h1>PLE System Login</h1>
        </header>

        <main>
            <div class=\"login-form\">
                {% if error %}
                    <div class=\"error-message\">
                        {{ error }}
                    </div>
                {% endif %}

                <form method=\"POST\" action=\"index.php?action=login\">
                    <div class=\"form-group\">
                        <label for=\"username\">Username:</label>
                        <input type=\"text\" name=\"username\" id=\"username\" required>
                    </div>

                    <div class=\"form-group\">
                        <label for=\"password\">Password:</label>
                        <input type=\"password\" name=\"password\" id=\"password\" required>
                    </div>

                    <button type=\"submit\" class=\"button-primary\">Login</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
", "login.twig", "/home/ubuntu/repos/PLE/php-backend/templates/login.twig");
    }
}
