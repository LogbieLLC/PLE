<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8373e2416a91b03a471103b0ecee155c
{
    public static $files = array (
        '6e3fae29631ef280660b3cdad06f25a8' => __DIR__ . '/..' . '/symfony/deprecation-contracts/function.php',
        '320cde22f66dd4f5d3fd621d3e88b98f' => __DIR__ . '/..' . '/symfony/polyfill-ctype/bootstrap.php',
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        '23c18046f52bef3eea034657bafda50f' => __DIR__ . '/..' . '/symfony/polyfill-php81/bootstrap.php',
        '9b38cf48e83f5d8f60375221cd213eee' => __DIR__ . '/..' . '/phpstan/phpstan/bootstrap.php',
        '89efb1254ef2d1c5d80096acd12c4098' => __DIR__ . '/..' . '/twig/twig/src/Resources/core.php',
        'ffecb95d45175fd40f75be8a23b34f90' => __DIR__ . '/..' . '/twig/twig/src/Resources/debug.php',
        'c7baa00073ee9c61edf148c51917cfb4' => __DIR__ . '/..' . '/twig/twig/src/Resources/escaper.php',
        'f844ccf1d25df8663951193c3fc307c8' => __DIR__ . '/..' . '/twig/twig/src/Resources/string_loader.php',
    );

    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Twig\\' => 5,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Php81\\' => 23,
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Polyfill\\Ctype\\' => 23,
        ),
        'R' => 
        array (
            'RedBeanPHP\\' => 11,
        ),
        'P' => 
        array (
            'PLEPHP\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Twig\\' => 
        array (
            0 => __DIR__ . '/..' . '/twig/twig/src',
        ),
        'Symfony\\Polyfill\\Php81\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-php81',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Polyfill\\Ctype\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-ctype',
        ),
        'RedBeanPHP\\' => 
        array (
            0 => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP',
        ),
        'PLEPHP\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'CURLStringFile' => __DIR__ . '/..' . '/symfony/polyfill-php81/Resources/stubs/CURLStringFile.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'PLEPHP\\Model\\Checklist' => __DIR__ . '/../..' . '/src/Model/Checklist.php',
        'PLEPHP\\Model\\Equipment' => __DIR__ . '/../..' . '/src/Model/Equipment.php',
        'RedBeanPHP\\Adapter' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/Adapter.php',
        'RedBeanPHP\\Adapter\\DBAdapter' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/Adapter/DBAdapter.php',
        'RedBeanPHP\\AssociationManager' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/AssociationManager.php',
        'RedBeanPHP\\BeanCollection' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/BeanCollection.php',
        'RedBeanPHP\\BeanHelper' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/BeanHelper.php',
        'RedBeanPHP\\BeanHelper\\DynamicBeanHelper' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/BeanHelper/DynamicBeanHelper.php',
        'RedBeanPHP\\BeanHelper\\SimpleFacadeBeanHelper' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/BeanHelper/SimpleFacadeBeanHelper.php',
        'RedBeanPHP\\Cursor' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/Cursor.php',
        'RedBeanPHP\\Cursor\\NullCursor' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/Cursor/NullCursor.php',
        'RedBeanPHP\\Cursor\\PDOCursor' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/Cursor/PDOCursor.php',
        'RedBeanPHP\\Driver' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/Driver.php',
        'RedBeanPHP\\Driver\\RPDO' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/Driver/RPDO.php',
        'RedBeanPHP\\DuplicationManager' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/DuplicationManager.php',
        'RedBeanPHP\\Facade' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/Facade.php',
        'RedBeanPHP\\Finder' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/Finder.php',
        'RedBeanPHP\\LabelMaker' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/LabelMaker.php',
        'RedBeanPHP\\Logger' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/Logger.php',
        'RedBeanPHP\\Logger\\RDefault' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/Logger/RDefault.php',
        'RedBeanPHP\\Logger\\RDefault\\Debug' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/Logger/RDefault/Debug.php',
        'RedBeanPHP\\OODB' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/OODB.php',
        'RedBeanPHP\\OODBBean' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/OODBBean.php',
        'RedBeanPHP\\Observable' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/Observable.php',
        'RedBeanPHP\\Observer' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/Observer.php',
        'RedBeanPHP\\Plugin' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/Plugin.php',
        'RedBeanPHP\\QueryWriter' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/QueryWriter.php',
        'RedBeanPHP\\QueryWriter\\AQueryWriter' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/QueryWriter/AQueryWriter.php',
        'RedBeanPHP\\QueryWriter\\CUBRID' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/QueryWriter/CUBRID.php',
        'RedBeanPHP\\QueryWriter\\Firebird' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/QueryWriter/Firebird.php',
        'RedBeanPHP\\QueryWriter\\MySQL' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/QueryWriter/MySQL.php',
        'RedBeanPHP\\QueryWriter\\PostgreSQL' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/QueryWriter/PostgreSQL.php',
        'RedBeanPHP\\QueryWriter\\SQLiteT' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/QueryWriter/SQLiteT.php',
        'RedBeanPHP\\R' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/R.php',
        'RedBeanPHP\\RedException' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/RedException.php',
        'RedBeanPHP\\RedException\\SQL' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/RedException/SQL.php',
        'RedBeanPHP\\Repository' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/Repository.php',
        'RedBeanPHP\\Repository\\Fluid' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/Repository/Fluid.php',
        'RedBeanPHP\\Repository\\Frozen' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/Repository/Frozen.php',
        'RedBeanPHP\\SimpleModel' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/SimpleModel.php',
        'RedBeanPHP\\SimpleModelHelper' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/SimpleModelHelper.php',
        'RedBeanPHP\\TagManager' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/TagManager.php',
        'RedBeanPHP\\ToolBox' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/ToolBox.php',
        'RedBeanPHP\\TypedModel' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/TypedModel.php',
        'RedBeanPHP\\Util\\ArrayTool' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/Util/ArrayTool.php',
        'RedBeanPHP\\Util\\Diff' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/Util/Diff.php',
        'RedBeanPHP\\Util\\DispenseHelper' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/Util/DispenseHelper.php',
        'RedBeanPHP\\Util\\Dump' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/Util/Dump.php',
        'RedBeanPHP\\Util\\Either' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/Util/Either.php',
        'RedBeanPHP\\Util\\Feature' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/Util/Feature.php',
        'RedBeanPHP\\Util\\Look' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/Util/Look.php',
        'RedBeanPHP\\Util\\MatchUp' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/Util/MatchUp.php',
        'RedBeanPHP\\Util\\MultiLoader' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/Util/MultiLoader.php',
        'RedBeanPHP\\Util\\QuickExport' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/Util/QuickExport.php',
        'RedBeanPHP\\Util\\Transaction' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/Util/Transaction.php',
        'RedBeanPHP\\Util\\Tree' => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP/Util/Tree.php',
        'ReturnTypeWillChange' => __DIR__ . '/..' . '/symfony/polyfill-php81/Resources/stubs/ReturnTypeWillChange.php',
        'Symfony\\Polyfill\\Ctype\\Ctype' => __DIR__ . '/..' . '/symfony/polyfill-ctype/Ctype.php',
        'Symfony\\Polyfill\\Mbstring\\Mbstring' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/Mbstring.php',
        'Symfony\\Polyfill\\Php81\\Php81' => __DIR__ . '/..' . '/symfony/polyfill-php81/Php81.php',
        'Twig\\AbstractTwigCallable' => __DIR__ . '/..' . '/twig/twig/src/AbstractTwigCallable.php',
        'Twig\\Attribute\\FirstClassTwigCallableReady' => __DIR__ . '/..' . '/twig/twig/src/Attribute/FirstClassTwigCallableReady.php',
        'Twig\\Attribute\\YieldReady' => __DIR__ . '/..' . '/twig/twig/src/Attribute/YieldReady.php',
        'Twig\\Cache\\CacheInterface' => __DIR__ . '/..' . '/twig/twig/src/Cache/CacheInterface.php',
        'Twig\\Cache\\ChainCache' => __DIR__ . '/..' . '/twig/twig/src/Cache/ChainCache.php',
        'Twig\\Cache\\FilesystemCache' => __DIR__ . '/..' . '/twig/twig/src/Cache/FilesystemCache.php',
        'Twig\\Cache\\NullCache' => __DIR__ . '/..' . '/twig/twig/src/Cache/NullCache.php',
        'Twig\\Cache\\ReadOnlyFilesystemCache' => __DIR__ . '/..' . '/twig/twig/src/Cache/ReadOnlyFilesystemCache.php',
        'Twig\\Cache\\RemovableCacheInterface' => __DIR__ . '/..' . '/twig/twig/src/Cache/RemovableCacheInterface.php',
        'Twig\\Compiler' => __DIR__ . '/..' . '/twig/twig/src/Compiler.php',
        'Twig\\DeprecatedCallableInfo' => __DIR__ . '/..' . '/twig/twig/src/DeprecatedCallableInfo.php',
        'Twig\\Environment' => __DIR__ . '/..' . '/twig/twig/src/Environment.php',
        'Twig\\Error\\Error' => __DIR__ . '/..' . '/twig/twig/src/Error/Error.php',
        'Twig\\Error\\LoaderError' => __DIR__ . '/..' . '/twig/twig/src/Error/LoaderError.php',
        'Twig\\Error\\RuntimeError' => __DIR__ . '/..' . '/twig/twig/src/Error/RuntimeError.php',
        'Twig\\Error\\SyntaxError' => __DIR__ . '/..' . '/twig/twig/src/Error/SyntaxError.php',
        'Twig\\ExpressionParser' => __DIR__ . '/..' . '/twig/twig/src/ExpressionParser.php',
        'Twig\\ExtensionSet' => __DIR__ . '/..' . '/twig/twig/src/ExtensionSet.php',
        'Twig\\Extension\\AbstractExtension' => __DIR__ . '/..' . '/twig/twig/src/Extension/AbstractExtension.php',
        'Twig\\Extension\\CoreExtension' => __DIR__ . '/..' . '/twig/twig/src/Extension/CoreExtension.php',
        'Twig\\Extension\\DebugExtension' => __DIR__ . '/..' . '/twig/twig/src/Extension/DebugExtension.php',
        'Twig\\Extension\\EscaperExtension' => __DIR__ . '/..' . '/twig/twig/src/Extension/EscaperExtension.php',
        'Twig\\Extension\\ExtensionInterface' => __DIR__ . '/..' . '/twig/twig/src/Extension/ExtensionInterface.php',
        'Twig\\Extension\\GlobalsInterface' => __DIR__ . '/..' . '/twig/twig/src/Extension/GlobalsInterface.php',
        'Twig\\Extension\\OptimizerExtension' => __DIR__ . '/..' . '/twig/twig/src/Extension/OptimizerExtension.php',
        'Twig\\Extension\\ProfilerExtension' => __DIR__ . '/..' . '/twig/twig/src/Extension/ProfilerExtension.php',
        'Twig\\Extension\\RuntimeExtensionInterface' => __DIR__ . '/..' . '/twig/twig/src/Extension/RuntimeExtensionInterface.php',
        'Twig\\Extension\\SandboxExtension' => __DIR__ . '/..' . '/twig/twig/src/Extension/SandboxExtension.php',
        'Twig\\Extension\\StagingExtension' => __DIR__ . '/..' . '/twig/twig/src/Extension/StagingExtension.php',
        'Twig\\Extension\\StringLoaderExtension' => __DIR__ . '/..' . '/twig/twig/src/Extension/StringLoaderExtension.php',
        'Twig\\Extension\\YieldNotReadyExtension' => __DIR__ . '/..' . '/twig/twig/src/Extension/YieldNotReadyExtension.php',
        'Twig\\FileExtensionEscapingStrategy' => __DIR__ . '/..' . '/twig/twig/src/FileExtensionEscapingStrategy.php',
        'Twig\\Lexer' => __DIR__ . '/..' . '/twig/twig/src/Lexer.php',
        'Twig\\Loader\\ArrayLoader' => __DIR__ . '/..' . '/twig/twig/src/Loader/ArrayLoader.php',
        'Twig\\Loader\\ChainLoader' => __DIR__ . '/..' . '/twig/twig/src/Loader/ChainLoader.php',
        'Twig\\Loader\\FilesystemLoader' => __DIR__ . '/..' . '/twig/twig/src/Loader/FilesystemLoader.php',
        'Twig\\Loader\\LoaderInterface' => __DIR__ . '/..' . '/twig/twig/src/Loader/LoaderInterface.php',
        'Twig\\Markup' => __DIR__ . '/..' . '/twig/twig/src/Markup.php',
        'Twig\\NodeTraverser' => __DIR__ . '/..' . '/twig/twig/src/NodeTraverser.php',
        'Twig\\NodeVisitor\\AbstractNodeVisitor' => __DIR__ . '/..' . '/twig/twig/src/NodeVisitor/AbstractNodeVisitor.php',
        'Twig\\NodeVisitor\\EscaperNodeVisitor' => __DIR__ . '/..' . '/twig/twig/src/NodeVisitor/EscaperNodeVisitor.php',
        'Twig\\NodeVisitor\\NodeVisitorInterface' => __DIR__ . '/..' . '/twig/twig/src/NodeVisitor/NodeVisitorInterface.php',
        'Twig\\NodeVisitor\\OptimizerNodeVisitor' => __DIR__ . '/..' . '/twig/twig/src/NodeVisitor/OptimizerNodeVisitor.php',
        'Twig\\NodeVisitor\\SafeAnalysisNodeVisitor' => __DIR__ . '/..' . '/twig/twig/src/NodeVisitor/SafeAnalysisNodeVisitor.php',
        'Twig\\NodeVisitor\\SandboxNodeVisitor' => __DIR__ . '/..' . '/twig/twig/src/NodeVisitor/SandboxNodeVisitor.php',
        'Twig\\NodeVisitor\\YieldNotReadyNodeVisitor' => __DIR__ . '/..' . '/twig/twig/src/NodeVisitor/YieldNotReadyNodeVisitor.php',
        'Twig\\Node\\AutoEscapeNode' => __DIR__ . '/..' . '/twig/twig/src/Node/AutoEscapeNode.php',
        'Twig\\Node\\BlockNode' => __DIR__ . '/..' . '/twig/twig/src/Node/BlockNode.php',
        'Twig\\Node\\BlockReferenceNode' => __DIR__ . '/..' . '/twig/twig/src/Node/BlockReferenceNode.php',
        'Twig\\Node\\BodyNode' => __DIR__ . '/..' . '/twig/twig/src/Node/BodyNode.php',
        'Twig\\Node\\CaptureNode' => __DIR__ . '/..' . '/twig/twig/src/Node/CaptureNode.php',
        'Twig\\Node\\CheckSecurityCallNode' => __DIR__ . '/..' . '/twig/twig/src/Node/CheckSecurityCallNode.php',
        'Twig\\Node\\CheckSecurityNode' => __DIR__ . '/..' . '/twig/twig/src/Node/CheckSecurityNode.php',
        'Twig\\Node\\CheckToStringNode' => __DIR__ . '/..' . '/twig/twig/src/Node/CheckToStringNode.php',
        'Twig\\Node\\DeprecatedNode' => __DIR__ . '/..' . '/twig/twig/src/Node/DeprecatedNode.php',
        'Twig\\Node\\DoNode' => __DIR__ . '/..' . '/twig/twig/src/Node/DoNode.php',
        'Twig\\Node\\EmbedNode' => __DIR__ . '/..' . '/twig/twig/src/Node/EmbedNode.php',
        'Twig\\Node\\EmptyNode' => __DIR__ . '/..' . '/twig/twig/src/Node/EmptyNode.php',
        'Twig\\Node\\Expression\\AbstractExpression' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/AbstractExpression.php',
        'Twig\\Node\\Expression\\ArrayExpression' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/ArrayExpression.php',
        'Twig\\Node\\Expression\\ArrowFunctionExpression' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/ArrowFunctionExpression.php',
        'Twig\\Node\\Expression\\AssignNameExpression' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/AssignNameExpression.php',
        'Twig\\Node\\Expression\\Binary\\AbstractBinary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Binary/AbstractBinary.php',
        'Twig\\Node\\Expression\\Binary\\AddBinary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Binary/AddBinary.php',
        'Twig\\Node\\Expression\\Binary\\AndBinary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Binary/AndBinary.php',
        'Twig\\Node\\Expression\\Binary\\BitwiseAndBinary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Binary/BitwiseAndBinary.php',
        'Twig\\Node\\Expression\\Binary\\BitwiseOrBinary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Binary/BitwiseOrBinary.php',
        'Twig\\Node\\Expression\\Binary\\BitwiseXorBinary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Binary/BitwiseXorBinary.php',
        'Twig\\Node\\Expression\\Binary\\ConcatBinary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Binary/ConcatBinary.php',
        'Twig\\Node\\Expression\\Binary\\DivBinary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Binary/DivBinary.php',
        'Twig\\Node\\Expression\\Binary\\ElvisBinary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Binary/ElvisBinary.php',
        'Twig\\Node\\Expression\\Binary\\EndsWithBinary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Binary/EndsWithBinary.php',
        'Twig\\Node\\Expression\\Binary\\EqualBinary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Binary/EqualBinary.php',
        'Twig\\Node\\Expression\\Binary\\FloorDivBinary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Binary/FloorDivBinary.php',
        'Twig\\Node\\Expression\\Binary\\GreaterBinary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Binary/GreaterBinary.php',
        'Twig\\Node\\Expression\\Binary\\GreaterEqualBinary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Binary/GreaterEqualBinary.php',
        'Twig\\Node\\Expression\\Binary\\HasEveryBinary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Binary/HasEveryBinary.php',
        'Twig\\Node\\Expression\\Binary\\HasSomeBinary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Binary/HasSomeBinary.php',
        'Twig\\Node\\Expression\\Binary\\InBinary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Binary/InBinary.php',
        'Twig\\Node\\Expression\\Binary\\LessBinary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Binary/LessBinary.php',
        'Twig\\Node\\Expression\\Binary\\LessEqualBinary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Binary/LessEqualBinary.php',
        'Twig\\Node\\Expression\\Binary\\MatchesBinary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Binary/MatchesBinary.php',
        'Twig\\Node\\Expression\\Binary\\ModBinary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Binary/ModBinary.php',
        'Twig\\Node\\Expression\\Binary\\MulBinary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Binary/MulBinary.php',
        'Twig\\Node\\Expression\\Binary\\NotEqualBinary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Binary/NotEqualBinary.php',
        'Twig\\Node\\Expression\\Binary\\NotInBinary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Binary/NotInBinary.php',
        'Twig\\Node\\Expression\\Binary\\NullCoalesceBinary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Binary/NullCoalesceBinary.php',
        'Twig\\Node\\Expression\\Binary\\OrBinary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Binary/OrBinary.php',
        'Twig\\Node\\Expression\\Binary\\PowerBinary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Binary/PowerBinary.php',
        'Twig\\Node\\Expression\\Binary\\RangeBinary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Binary/RangeBinary.php',
        'Twig\\Node\\Expression\\Binary\\SpaceshipBinary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Binary/SpaceshipBinary.php',
        'Twig\\Node\\Expression\\Binary\\StartsWithBinary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Binary/StartsWithBinary.php',
        'Twig\\Node\\Expression\\Binary\\SubBinary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Binary/SubBinary.php',
        'Twig\\Node\\Expression\\Binary\\XorBinary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Binary/XorBinary.php',
        'Twig\\Node\\Expression\\BlockReferenceExpression' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/BlockReferenceExpression.php',
        'Twig\\Node\\Expression\\CallExpression' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/CallExpression.php',
        'Twig\\Node\\Expression\\ConditionalExpression' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/ConditionalExpression.php',
        'Twig\\Node\\Expression\\ConstantExpression' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/ConstantExpression.php',
        'Twig\\Node\\Expression\\FilterExpression' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/FilterExpression.php',
        'Twig\\Node\\Expression\\Filter\\DefaultFilter' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Filter/DefaultFilter.php',
        'Twig\\Node\\Expression\\Filter\\RawFilter' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Filter/RawFilter.php',
        'Twig\\Node\\Expression\\FunctionExpression' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/FunctionExpression.php',
        'Twig\\Node\\Expression\\FunctionNode\\EnumCasesFunction' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/FunctionNode/EnumCasesFunction.php',
        'Twig\\Node\\Expression\\FunctionNode\\EnumFunction' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/FunctionNode/EnumFunction.php',
        'Twig\\Node\\Expression\\GetAttrExpression' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/GetAttrExpression.php',
        'Twig\\Node\\Expression\\InlinePrint' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/InlinePrint.php',
        'Twig\\Node\\Expression\\MacroReferenceExpression' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/MacroReferenceExpression.php',
        'Twig\\Node\\Expression\\MethodCallExpression' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/MethodCallExpression.php',
        'Twig\\Node\\Expression\\NameExpression' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/NameExpression.php',
        'Twig\\Node\\Expression\\NullCoalesceExpression' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/NullCoalesceExpression.php',
        'Twig\\Node\\Expression\\OperatorEscapeInterface' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/OperatorEscapeInterface.php',
        'Twig\\Node\\Expression\\ParentExpression' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/ParentExpression.php',
        'Twig\\Node\\Expression\\TempNameExpression' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/TempNameExpression.php',
        'Twig\\Node\\Expression\\Ternary\\ConditionalTernary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Ternary/ConditionalTernary.php',
        'Twig\\Node\\Expression\\TestExpression' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/TestExpression.php',
        'Twig\\Node\\Expression\\Test\\ConstantTest' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Test/ConstantTest.php',
        'Twig\\Node\\Expression\\Test\\DefinedTest' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Test/DefinedTest.php',
        'Twig\\Node\\Expression\\Test\\DivisiblebyTest' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Test/DivisiblebyTest.php',
        'Twig\\Node\\Expression\\Test\\EvenTest' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Test/EvenTest.php',
        'Twig\\Node\\Expression\\Test\\NullTest' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Test/NullTest.php',
        'Twig\\Node\\Expression\\Test\\OddTest' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Test/OddTest.php',
        'Twig\\Node\\Expression\\Test\\SameasTest' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Test/SameasTest.php',
        'Twig\\Node\\Expression\\Unary\\AbstractUnary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Unary/AbstractUnary.php',
        'Twig\\Node\\Expression\\Unary\\NegUnary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Unary/NegUnary.php',
        'Twig\\Node\\Expression\\Unary\\NotUnary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Unary/NotUnary.php',
        'Twig\\Node\\Expression\\Unary\\PosUnary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Unary/PosUnary.php',
        'Twig\\Node\\Expression\\Unary\\SpreadUnary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Unary/SpreadUnary.php',
        'Twig\\Node\\Expression\\Unary\\StringCastUnary' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Unary/StringCastUnary.php',
        'Twig\\Node\\Expression\\Variable\\AssignContextVariable' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Variable/AssignContextVariable.php',
        'Twig\\Node\\Expression\\Variable\\AssignTemplateVariable' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Variable/AssignTemplateVariable.php',
        'Twig\\Node\\Expression\\Variable\\ContextVariable' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Variable/ContextVariable.php',
        'Twig\\Node\\Expression\\Variable\\LocalVariable' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Variable/LocalVariable.php',
        'Twig\\Node\\Expression\\Variable\\TemplateVariable' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/Variable/TemplateVariable.php',
        'Twig\\Node\\Expression\\VariadicExpression' => __DIR__ . '/..' . '/twig/twig/src/Node/Expression/VariadicExpression.php',
        'Twig\\Node\\FlushNode' => __DIR__ . '/..' . '/twig/twig/src/Node/FlushNode.php',
        'Twig\\Node\\ForLoopNode' => __DIR__ . '/..' . '/twig/twig/src/Node/ForLoopNode.php',
        'Twig\\Node\\ForNode' => __DIR__ . '/..' . '/twig/twig/src/Node/ForNode.php',
        'Twig\\Node\\IfNode' => __DIR__ . '/..' . '/twig/twig/src/Node/IfNode.php',
        'Twig\\Node\\ImportNode' => __DIR__ . '/..' . '/twig/twig/src/Node/ImportNode.php',
        'Twig\\Node\\IncludeNode' => __DIR__ . '/..' . '/twig/twig/src/Node/IncludeNode.php',
        'Twig\\Node\\MacroNode' => __DIR__ . '/..' . '/twig/twig/src/Node/MacroNode.php',
        'Twig\\Node\\ModuleNode' => __DIR__ . '/..' . '/twig/twig/src/Node/ModuleNode.php',
        'Twig\\Node\\NameDeprecation' => __DIR__ . '/..' . '/twig/twig/src/Node/NameDeprecation.php',
        'Twig\\Node\\Node' => __DIR__ . '/..' . '/twig/twig/src/Node/Node.php',
        'Twig\\Node\\NodeCaptureInterface' => __DIR__ . '/..' . '/twig/twig/src/Node/NodeCaptureInterface.php',
        'Twig\\Node\\NodeOutputInterface' => __DIR__ . '/..' . '/twig/twig/src/Node/NodeOutputInterface.php',
        'Twig\\Node\\Nodes' => __DIR__ . '/..' . '/twig/twig/src/Node/Nodes.php',
        'Twig\\Node\\PrintNode' => __DIR__ . '/..' . '/twig/twig/src/Node/PrintNode.php',
        'Twig\\Node\\SandboxNode' => __DIR__ . '/..' . '/twig/twig/src/Node/SandboxNode.php',
        'Twig\\Node\\SetNode' => __DIR__ . '/..' . '/twig/twig/src/Node/SetNode.php',
        'Twig\\Node\\TextNode' => __DIR__ . '/..' . '/twig/twig/src/Node/TextNode.php',
        'Twig\\Node\\TypesNode' => __DIR__ . '/..' . '/twig/twig/src/Node/TypesNode.php',
        'Twig\\Node\\WithNode' => __DIR__ . '/..' . '/twig/twig/src/Node/WithNode.php',
        'Twig\\OperatorPrecedenceChange' => __DIR__ . '/..' . '/twig/twig/src/OperatorPrecedenceChange.php',
        'Twig\\Parser' => __DIR__ . '/..' . '/twig/twig/src/Parser.php',
        'Twig\\Profiler\\Dumper\\BaseDumper' => __DIR__ . '/..' . '/twig/twig/src/Profiler/Dumper/BaseDumper.php',
        'Twig\\Profiler\\Dumper\\BlackfireDumper' => __DIR__ . '/..' . '/twig/twig/src/Profiler/Dumper/BlackfireDumper.php',
        'Twig\\Profiler\\Dumper\\HtmlDumper' => __DIR__ . '/..' . '/twig/twig/src/Profiler/Dumper/HtmlDumper.php',
        'Twig\\Profiler\\Dumper\\TextDumper' => __DIR__ . '/..' . '/twig/twig/src/Profiler/Dumper/TextDumper.php',
        'Twig\\Profiler\\NodeVisitor\\ProfilerNodeVisitor' => __DIR__ . '/..' . '/twig/twig/src/Profiler/NodeVisitor/ProfilerNodeVisitor.php',
        'Twig\\Profiler\\Node\\EnterProfileNode' => __DIR__ . '/..' . '/twig/twig/src/Profiler/Node/EnterProfileNode.php',
        'Twig\\Profiler\\Node\\LeaveProfileNode' => __DIR__ . '/..' . '/twig/twig/src/Profiler/Node/LeaveProfileNode.php',
        'Twig\\Profiler\\Profile' => __DIR__ . '/..' . '/twig/twig/src/Profiler/Profile.php',
        'Twig\\RuntimeLoader\\ContainerRuntimeLoader' => __DIR__ . '/..' . '/twig/twig/src/RuntimeLoader/ContainerRuntimeLoader.php',
        'Twig\\RuntimeLoader\\FactoryRuntimeLoader' => __DIR__ . '/..' . '/twig/twig/src/RuntimeLoader/FactoryRuntimeLoader.php',
        'Twig\\RuntimeLoader\\RuntimeLoaderInterface' => __DIR__ . '/..' . '/twig/twig/src/RuntimeLoader/RuntimeLoaderInterface.php',
        'Twig\\Runtime\\EscaperRuntime' => __DIR__ . '/..' . '/twig/twig/src/Runtime/EscaperRuntime.php',
        'Twig\\Sandbox\\SecurityError' => __DIR__ . '/..' . '/twig/twig/src/Sandbox/SecurityError.php',
        'Twig\\Sandbox\\SecurityNotAllowedFilterError' => __DIR__ . '/..' . '/twig/twig/src/Sandbox/SecurityNotAllowedFilterError.php',
        'Twig\\Sandbox\\SecurityNotAllowedFunctionError' => __DIR__ . '/..' . '/twig/twig/src/Sandbox/SecurityNotAllowedFunctionError.php',
        'Twig\\Sandbox\\SecurityNotAllowedMethodError' => __DIR__ . '/..' . '/twig/twig/src/Sandbox/SecurityNotAllowedMethodError.php',
        'Twig\\Sandbox\\SecurityNotAllowedPropertyError' => __DIR__ . '/..' . '/twig/twig/src/Sandbox/SecurityNotAllowedPropertyError.php',
        'Twig\\Sandbox\\SecurityNotAllowedTagError' => __DIR__ . '/..' . '/twig/twig/src/Sandbox/SecurityNotAllowedTagError.php',
        'Twig\\Sandbox\\SecurityPolicy' => __DIR__ . '/..' . '/twig/twig/src/Sandbox/SecurityPolicy.php',
        'Twig\\Sandbox\\SecurityPolicyInterface' => __DIR__ . '/..' . '/twig/twig/src/Sandbox/SecurityPolicyInterface.php',
        'Twig\\Sandbox\\SourcePolicyInterface' => __DIR__ . '/..' . '/twig/twig/src/Sandbox/SourcePolicyInterface.php',
        'Twig\\Source' => __DIR__ . '/..' . '/twig/twig/src/Source.php',
        'Twig\\Template' => __DIR__ . '/..' . '/twig/twig/src/Template.php',
        'Twig\\TemplateWrapper' => __DIR__ . '/..' . '/twig/twig/src/TemplateWrapper.php',
        'Twig\\Test\\IntegrationTestCase' => __DIR__ . '/..' . '/twig/twig/src/Test/IntegrationTestCase.php',
        'Twig\\Test\\NodeTestCase' => __DIR__ . '/..' . '/twig/twig/src/Test/NodeTestCase.php',
        'Twig\\Token' => __DIR__ . '/..' . '/twig/twig/src/Token.php',
        'Twig\\TokenParser\\AbstractTokenParser' => __DIR__ . '/..' . '/twig/twig/src/TokenParser/AbstractTokenParser.php',
        'Twig\\TokenParser\\ApplyTokenParser' => __DIR__ . '/..' . '/twig/twig/src/TokenParser/ApplyTokenParser.php',
        'Twig\\TokenParser\\AutoEscapeTokenParser' => __DIR__ . '/..' . '/twig/twig/src/TokenParser/AutoEscapeTokenParser.php',
        'Twig\\TokenParser\\BlockTokenParser' => __DIR__ . '/..' . '/twig/twig/src/TokenParser/BlockTokenParser.php',
        'Twig\\TokenParser\\DeprecatedTokenParser' => __DIR__ . '/..' . '/twig/twig/src/TokenParser/DeprecatedTokenParser.php',
        'Twig\\TokenParser\\DoTokenParser' => __DIR__ . '/..' . '/twig/twig/src/TokenParser/DoTokenParser.php',
        'Twig\\TokenParser\\EmbedTokenParser' => __DIR__ . '/..' . '/twig/twig/src/TokenParser/EmbedTokenParser.php',
        'Twig\\TokenParser\\ExtendsTokenParser' => __DIR__ . '/..' . '/twig/twig/src/TokenParser/ExtendsTokenParser.php',
        'Twig\\TokenParser\\FlushTokenParser' => __DIR__ . '/..' . '/twig/twig/src/TokenParser/FlushTokenParser.php',
        'Twig\\TokenParser\\ForTokenParser' => __DIR__ . '/..' . '/twig/twig/src/TokenParser/ForTokenParser.php',
        'Twig\\TokenParser\\FromTokenParser' => __DIR__ . '/..' . '/twig/twig/src/TokenParser/FromTokenParser.php',
        'Twig\\TokenParser\\GuardTokenParser' => __DIR__ . '/..' . '/twig/twig/src/TokenParser/GuardTokenParser.php',
        'Twig\\TokenParser\\IfTokenParser' => __DIR__ . '/..' . '/twig/twig/src/TokenParser/IfTokenParser.php',
        'Twig\\TokenParser\\ImportTokenParser' => __DIR__ . '/..' . '/twig/twig/src/TokenParser/ImportTokenParser.php',
        'Twig\\TokenParser\\IncludeTokenParser' => __DIR__ . '/..' . '/twig/twig/src/TokenParser/IncludeTokenParser.php',
        'Twig\\TokenParser\\MacroTokenParser' => __DIR__ . '/..' . '/twig/twig/src/TokenParser/MacroTokenParser.php',
        'Twig\\TokenParser\\SandboxTokenParser' => __DIR__ . '/..' . '/twig/twig/src/TokenParser/SandboxTokenParser.php',
        'Twig\\TokenParser\\SetTokenParser' => __DIR__ . '/..' . '/twig/twig/src/TokenParser/SetTokenParser.php',
        'Twig\\TokenParser\\TokenParserInterface' => __DIR__ . '/..' . '/twig/twig/src/TokenParser/TokenParserInterface.php',
        'Twig\\TokenParser\\TypesTokenParser' => __DIR__ . '/..' . '/twig/twig/src/TokenParser/TypesTokenParser.php',
        'Twig\\TokenParser\\UseTokenParser' => __DIR__ . '/..' . '/twig/twig/src/TokenParser/UseTokenParser.php',
        'Twig\\TokenParser\\WithTokenParser' => __DIR__ . '/..' . '/twig/twig/src/TokenParser/WithTokenParser.php',
        'Twig\\TokenStream' => __DIR__ . '/..' . '/twig/twig/src/TokenStream.php',
        'Twig\\TwigCallableInterface' => __DIR__ . '/..' . '/twig/twig/src/TwigCallableInterface.php',
        'Twig\\TwigFilter' => __DIR__ . '/..' . '/twig/twig/src/TwigFilter.php',
        'Twig\\TwigFunction' => __DIR__ . '/..' . '/twig/twig/src/TwigFunction.php',
        'Twig\\TwigTest' => __DIR__ . '/..' . '/twig/twig/src/TwigTest.php',
        'Twig\\Util\\CallableArgumentsExtractor' => __DIR__ . '/..' . '/twig/twig/src/Util/CallableArgumentsExtractor.php',
        'Twig\\Util\\DeprecationCollector' => __DIR__ . '/..' . '/twig/twig/src/Util/DeprecationCollector.php',
        'Twig\\Util\\ReflectionCallable' => __DIR__ . '/..' . '/twig/twig/src/Util/ReflectionCallable.php',
        'Twig\\Util\\TemplateDirIterator' => __DIR__ . '/..' . '/twig/twig/src/Util/TemplateDirIterator.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8373e2416a91b03a471103b0ecee155c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8373e2416a91b03a471103b0ecee155c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8373e2416a91b03a471103b0ecee155c::$classMap;

        }, null, ClassLoader::class);
    }
}
