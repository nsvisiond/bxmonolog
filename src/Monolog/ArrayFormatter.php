<?php
namespace BX\Monolog;

use Monolog\Formatter\NormalizerFormatter;
use Monolog\LogRecord;

class ArrayFormatter extends NormalizerFormatter
{
	/**
	 * {@inheritdoc}
	 */
	public function format(LogRecord $record)
	{
		/** @var \DateTime $date */
		$date = $record['datetime'];
		$output = array(sprintf("%s %s", $record['level_name'], $date->format("d.m.Y H:i:s")));
        $output[] = $record['message'];
        if(!empty($record['context'])) {
            if(is_array($record['context'])) {
                $output[] = print_r($record['context'], true);
            } else {
                $output[] = $record['context'];
            }
        }

		return join("\r\n", $output) . "\r\n------------------------------------------------------------------------\r\n";
	}
}
