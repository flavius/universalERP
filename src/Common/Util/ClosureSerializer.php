<?php
/**
 * Copyright (c) 2014 Flavius Aspra <flavius.as@gmail.com>
 *
 * @license http://mozilla.org/MPL/2.0/ Mozilla Public License v.2.0
 */

namespace Common\Util;


class ClosureSerializer
{

    private $closure;

    /**
     * @param $closure \Closure
     */
    public function __construct($closure)
    {
        $this->closure = $closure;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        //function(Common\World\Command $command) use($world, $handlers)/path.php(28-35)
        if (is_object($this->closure) && method_exists($this->closure, '__invoke') && 'Closure' != get_class($this->closure)) {
            return $this->invokableToString($this->closure);
        } else {
            return $this->closureToString($this->closure);
        }
    }

    /**
     * @param $closure \Closure
     * @return string
     */
    private function closureToString($closure)
    {
        try {
            $baseDir = realpath(__DIR__ . '/../../../');
            $reflFunction = new \ReflectionFunction($closure);
            $functionName = "function";
            $namespaceName = $reflFunction->getNamespaceName();
            $params = [];
            foreach ($reflFunction->getParameters() as $reflParameter) {
                $params[] = $reflParameter->getClass()->getName() . " \$" . $reflParameter->getName();
            }
            $params = implode(", ", $params);
            $fileName = substr($reflFunction->getFileName(), strlen($baseDir));
            //$fileName = $reflFunction->getFileName();
            $startLine = $reflFunction->getStartLine();
            $endLine = $reflFunction->getEndLine();
            $staticVariables = [];
            foreach ($reflFunction->getStaticVariables() as $name => $staticVariable) {
                if (is_object($staticVariable)) {
                    $staticVariables[] = get_class($staticVariable) . " \$$name";
                } else {
                    if (is_array($staticVariable)) {
                        $valueType = gettype(current($staticVariable));
                        $keyType = gettype(key($staticVariable));
                        $staticVariables[] = "[$keyType]$valueType \$$name";
                    } else {
                        $staticVariables[] = "$staticVariable";
                    }
                }
            }
            $staticVariables = " use(" . implode(", ", $staticVariables) . ") ";
            return "{$namespaceName}\\{$functionName}($params)$staticVariables$fileName($startLine-$endLine)";
        } catch (\Exception $e) {
            return 'Exception ' . $e->getCode() . ' "' . $e->getMessage() . '"';
        }
    }

    /**
     * @param $callable callable
     */
    private function invokableToString($callable) {
        $class = get_class($callable);
        $method = "__invoke";
        $reflMethod = new \ReflectionMethod($callable, '__invoke');
        $params = [];
        foreach ($reflMethod->getParameters() as $reflParameter) {
            $params[] = $reflParameter->getClass()->getName() . " \$" . $reflParameter->getName();
        }
        $params = implode(", ", $params);

        return "$class::$method($params)";
    }
}