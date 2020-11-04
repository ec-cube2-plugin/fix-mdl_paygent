<?php

/*
 * This file is part of EC-CUBE2 CLI.
 *
 * (C) Tsuyoshi Tsurushima.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FixMdlPaygent\Command;

use Eccube2\Init;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class PaygentCopyCommand extends Command
{
    protected static $defaultName = 'paygent:copy';

    protected function configure()
    {
        $this
            ->setDescription('ペイジェントテンプレートのコピーを行います')
        ;
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        Init::init();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $io->title('ペイジェントテンプレート ファイルコピー');

        $directories = array(
            'mobile' => array(
                'from' => MODULE_REALDIR . MDL_PAYGENT_CODE . '/templates/mobile/',
                'to' => MOBILE_TEMPLATE_REALDIR . 'mdl_paygent/',
            ),
            'sphone' => array(
                'from' => MODULE_REALDIR . MDL_PAYGENT_CODE . '/templates/sphone/',
                'to' => SMARTPHONE_TEMPLATE_REALDIR . 'mdl_paygent/',
            ),
            'default' => array(
                'from' => MODULE_REALDIR . MDL_PAYGENT_CODE . '/templates/default/',
                'to' => TEMPLATE_REALDIR . 'mdl_paygent/',
            ),
        );

        foreach ($directories as $name => $directory) {
            $io->section($name);

            if (is_dir($directory['to'])) {
                if (!$io->confirm($directory['to'] . ' が存在します。強制的にコピーしますか？', false)) {
                    $io->text($directory['to'] . ' へのコピーをスキップしました');
                    continue;
                }
            }

            \SC_Utils_Ex::copyDirectory($directory['from'], $directory['to']);
            $io->text($directory['from'] . ' から ' . $directory['to'] . ' にコピーしました');
        }
    }
}
