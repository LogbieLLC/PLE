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

/* home.twig */
class __TwigTemplate_3da53e86d3065e20d292d1e8996a6638 extends Template
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
    <title>PLE System - Equipment List</title>
    <link rel=\"stylesheet\" href=\"/style.css\">
</head>
<body>
    <div class=\"container\">
        <header>
            <h1>Powered Lifting Equipment Management</h1>
            <nav>
                <a href=\"index.php?action=addEquipment\" class=\"button-primary\">Add New Equipment</a>
                <div class=\"user-info\">
                    Logged in as: ";
        // line 14
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "username", [], "any", false, false, false, 14), "html", null, true);
        yield "
                    <a href=\"index.php?action=logout\" class=\"button\">Logout</a>
                </div>
            </nav>
        </header>

        <main>
            <section class=\"equipment-list\">
                <h2>Equipment Inventory</h2>
                ";
        // line 23
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["equipment"] ?? null)) > 0)) {
            // line 24
            yield "                    <table>
                        <thead>
                            <tr>
                                <th>PLE ID</th>
                                <th>Type</th>
                                <th>Make</th>
                                <th>Model</th>
                                <th>Serial Number</th>
                                <th>Department</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            ";
            // line 37
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["equipment"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["eq"]) {
                // line 38
                yield "                                <tr>
                                    <td>";
                // line 39
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["eq"], "ple_id", [], "any", false, false, false, 39), "html", null, true);
                yield "</td>
                                    <td>";
                // line 40
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["eq"], "type", [], "any", false, false, false, 40), "html", null, true);
                yield "</td>
                                    <td>";
                // line 41
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["eq"], "make", [], "any", false, false, false, 41), "html", null, true);
                yield "</td>
                                    <td>";
                // line 42
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["eq"], "model", [], "any", false, false, false, 42), "html", null, true);
                yield "</td>
                                    <td>";
                // line 43
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["eq"], "serial_number", [], "any", false, false, false, 43), "html", null, true);
                yield "</td>
                                    <td>";
                // line 44
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["eq"], "department", [], "any", false, false, false, 44), "html", null, true);
                yield "</td>
                                    <td>
                                        <a href=\"index.php?action=editEquipment&id=";
                // line 46
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["eq"], "id", [], "any", false, false, false, 46), "html", null, true);
                yield "\" class=\"button\">Edit</a>
                                        <form method=\"POST\" action=\"index.php?action=deleteEquipment\" style=\"display: inline;\">
                                            <input type=\"hidden\" name=\"id\" value=\"";
                // line 48
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["eq"], "id", [], "any", false, false, false, 48), "html", null, true);
                yield "\">
                                            <button type=\"submit\" class=\"button-danger\" onclick=\"return confirm('Are you sure you want to delete this equipment?')\">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['eq'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 54
            yield "                        </tbody>
                    </table>
                ";
        } else {
            // line 57
            yield "                    <p>No equipment found. Add some using the button above.</p>
                ";
        }
        // line 59
        yield "            </section>
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
        return "home.twig";
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
        return array (  144 => 59,  140 => 57,  135 => 54,  123 => 48,  118 => 46,  113 => 44,  109 => 43,  105 => 42,  101 => 41,  97 => 40,  93 => 39,  90 => 38,  86 => 37,  71 => 24,  69 => 23,  57 => 14,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html>
<head>
    <title>PLE System - Equipment List</title>
    <link rel=\"stylesheet\" href=\"/style.css\">
</head>
<body>
    <div class=\"container\">
        <header>
            <h1>Powered Lifting Equipment Management</h1>
            <nav>
                <a href=\"index.php?action=addEquipment\" class=\"button-primary\">Add New Equipment</a>
                <div class=\"user-info\">
                    Logged in as: {{ user.username }}
                    <a href=\"index.php?action=logout\" class=\"button\">Logout</a>
                </div>
            </nav>
        </header>

        <main>
            <section class=\"equipment-list\">
                <h2>Equipment Inventory</h2>
                {% if equipment|length > 0 %}
                    <table>
                        <thead>
                            <tr>
                                <th>PLE ID</th>
                                <th>Type</th>
                                <th>Make</th>
                                <th>Model</th>
                                <th>Serial Number</th>
                                <th>Department</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {% for eq in equipment %}
                                <tr>
                                    <td>{{ eq.ple_id }}</td>
                                    <td>{{ eq.type }}</td>
                                    <td>{{ eq.make }}</td>
                                    <td>{{ eq.model }}</td>
                                    <td>{{ eq.serial_number }}</td>
                                    <td>{{ eq.department }}</td>
                                    <td>
                                        <a href=\"index.php?action=editEquipment&id={{ eq.id }}\" class=\"button\">Edit</a>
                                        <form method=\"POST\" action=\"index.php?action=deleteEquipment\" style=\"display: inline;\">
                                            <input type=\"hidden\" name=\"id\" value=\"{{ eq.id }}\">
                                            <button type=\"submit\" class=\"button-danger\" onclick=\"return confirm('Are you sure you want to delete this equipment?')\">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            {% endfor %}
                        </tbody>
                    </table>
                {% else %}
                    <p>No equipment found. Add some using the button above.</p>
                {% endif %}
            </section>
        </main>
    </div>
</body>
</html>
", "home.twig", "/home/ubuntu/repos/PLE/php-backend/templates/home.twig");
    }
}
