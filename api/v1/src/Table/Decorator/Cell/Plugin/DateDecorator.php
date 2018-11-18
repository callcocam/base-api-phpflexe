<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 04/09/2018
 * Time: 21:28
 */

namespace Flexe\Table\Decorator\Cell\Plugin;


use Carbon\Carbon;
use Flexe\Table\Decorator\Cell\AbstractCellDecorator;

class DateDecorator extends AbstractCellDecorator
{

    protected $vars;

    protected $url;

    /**
     * LinkCell constructor.
     * @param $options
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }


    public function render($context)
    {

        if(isset($this->options['time']) && $this->options['time']):

            $format = "d/m/Y H:i:s";

            if(isset($this->options['format'])):

                $format = $this->options['format'];

            endif;

		  return Carbon::createFromTimestamp($context)->format($format);

        else:

            $format = "d/m/Y";

            if(isset($this->options['format'])):

                $format = $this->options['format'];

            endif;

            return Carbon::create($context)->format($format);

        endif;
    }
	
	
}





















