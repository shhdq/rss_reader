<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\ExchangeRate;
use Feed;

class SaveFeedData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feed:save';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reads and saves the RSS feed';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $url = "https://www.bank.lv/vk/ecb_rss.xml";
        $feed = Feed::loadRss($url);

        if (empty($feed) || !count($feed->item)) {
            $this->error('Feed data not found.');
            return;
        }

        // Progress bar isn't needed, it's just extra visuals
        $itemCount = count($feed->item);
        $bar = $this->output->createProgressBar($itemCount);
        $bar->start();

        foreach ($feed->item as $item) {
            $this->saveExchangeRate($item);
            $bar->advance();
        }

        $bar->finish();
        $this->info('Feed data imported.');

        return;
    }

    public function saveExchangeRate($data)
    {
        $date = (new \DateTime('@' . $data->timestamp))
            ->setTimeZone(new \DateTimeZone('Europe/Riga'))
            ->format('Y-m-d');

        $item = ExchangeRate::updateOrCreate(
            ['pub_date' => $date],
            [
                'title' => $data->title->__toString(),
                'link' => $data->link->__toString(),
                'guid' => $data->guid->__toString(),
                'cdata' => $data->description->__toString()
            ]
        );


        return;
    }
}
