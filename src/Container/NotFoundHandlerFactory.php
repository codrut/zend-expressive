<?php
/**
 * @see       https://github.com/zendframework/zend-expressive for the canonical source repository
 * @copyright Copyright (c) 2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   https://github.com/zendframework/zend-expressive/blob/master/LICENSE.md New BSD License
 */

namespace Zend\Expressive\Container;

use Interop\Container\ContainerInterface;
use Zend\Diactoros\Response;
use Zend\Expressive\Middleware\NotFoundHandler;
use Zend\Expressive\Template\TemplateRendererInterface;

class NotFoundHandlerFactory
{
    /**
     * @param ContainerInterface $container
     * @return NotFoundHandler
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->has('config')
            ? $container->get('config')
            : [];

        $renderer = $container->has(TemplateRendererInterface::class)
            ? $container->get(TemplateRendererInterface::class)
            : null;

        $template = isset($config['zend-expressive']['error_handler']['template_404'])
            ? $config['zend-expressive']['error_handler']['template_404']
            : NotFoundHandler::TEMPLATE_DEFAULT;

        return new NotFoundHandler(new Response(), $renderer, $template);
    }
}