<?php
namespace Hostnet\Component\WebpackBundle\Configuration;

/**
 * A CodeBlock is a collection of JavaScript snippets that will be combined and compiled to one javascript file. This
 * file represents the final webpack configuration.
 *
 * Code-blocks allows injecting code in the following sections of the configuration file:
 *
 *      var webpack = require('webpack');
 *      <<header>>
 *
 *      module.exports = {
 *          entry : {
 *              // Generated by webpack-bundle
 *          },
 *          resolve : {
 *              <<resolve>>
 *          },
 *          plugins : [
 *              <<plugin>>
 *          ],
 *          module : {
 *              preLoaders : [
 *                  <<pre_loader>>
 *              ],
 *              loaders : [
 *                  <<loader>>
 *              ],
 *              post_loaders : [
 *                  <<post_loader_>>
 *              ],
 *          },
 *          output : {
 *              << output >>
 *          }
 *      };
 *
 * @author Harold Iedema <hiedema@hostnet.nl>
 */
class CodeBlock
{
    const HEADER         = 'header',
          ENTRY          = 'entry',
          RESOLVE        = 'resolve',
          RESOLVE_LOADER = 'resolve_loader',
          PLUGIN         = 'plugin',
          PRE_LOADER     = 'pre_loader',
          LOADER         = 'loader',
          POST_LOADER    = 'post_loader',
          OUTPUT         = 'output';

    // Available types to allow easy validation
    private $types  = [
        'entry', 'header', 'resolve', 'resolve_loader', 'plugin', 'pre_loader', 'loader', 'post_loader', 'output'
    ];

    // Chunks collection
    private $chunks = [];

    /**
     * @param  string $chunk
     * @param  string $code
     * @return CodeBlock
     */
    public function set($chunk, $code)
    {
        if (! in_array($chunk, $this->types)) {
            throw new \InvalidArgumentException(sprintf(
                'Invalid insertion point "%s". Available points are: %s.',
                $chunk,
                implode(", ", $this->types)
            ));
        }

        if (isset($this->chunks[$chunk])) {
            throw new \InvalidArgumentException(sprintf('The chunk "%s" is already in use.', $chunk));
        }

        $this->chunks[$chunk] = $code;

        return $this;
    }

    /**
     * Returns the code associated with the given chunk.
     *
     * @param  string $chunk
     * @return string
     */
    public function get($chunk)
    {
        if (! isset($this->chunks[$chunk])) {
            throw new \InvalidArgumentException(sprintf('This code block does not have a chunk for "%s".', $chunk));
        }

        return $this->chunks[$chunk];
    }

    /**
     * Returns true if this code-block has the given chunk defined.
     *
     * @param  string $chunk
     * @return bool
     */
    public function has($chunk)
    {
        return isset($this->chunks[$chunk]);
    }
}
