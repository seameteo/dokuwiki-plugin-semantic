<?php
/**
 * Semantic plugin: Add Schema.org News Article using JSON-LD
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 */
// must be run within Dokuwiki
if (!defined('DOKU_INC')) die();

class syntax_plugin_semantic_image extends DokuWiki_Syntax_Plugin {

  function getType() { return 'substition'; }
  function getPType() { return 'block'; }
  function getSort() { return 99; }

  function connectTo($mode) {
    $this->Lexer->addSpecialPattern('\{\{meta-image>.+?\}\}', $mode, 'plugin_semantic_image');
  }

  function handle($match, $state, $pos, Doku_Handler $handler){
    // Remove markup
    $match = substr($match, 14, -2);
    return array($match);
  }

  function render($mode, Doku_Renderer $renderer, $data) {
    $dir = $conf['mediadir'].'/'.utf8_encodeFN(str_replace(':','/',$data[0]));
    if ($mode == 'metadata') {
      $renderer->meta['plugin']['semantic']['custom_image'] = $dir;
      return true;
    }
    return false;
  }
}
