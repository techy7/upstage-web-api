<?php

use Illuminate\Database\Seeder;
use App\Listing;
use App\Item;
use Illuminate\Support\Arr;
use Faker\Generator as Faker;

class ListingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {  
        factory(App\Listing::class, 10)->create()->each(function ($list) use($faker) { 
 			$numOfItems = rand(2,6);
 			$imgVal = Arr::random(array(1,2,3,4,5,6,7,8,9,10), $numOfItems);

 			for ($i=0; $i < $numOfItems; $i++) {  
 				// create item here
	            $item = Item::create([
		            'label' =>$faker->realText($maxNbChars = rand(20, 50)),
		            'description' => $faker->realText($maxNbChars = rand(50, 200)),
		            'status' => 'raw',
		            'listing_id' => $list->id,
		            'user_id' => $list->user_id
		        ]);

	            // upload item image avatar
	            $item_path = storage_path().'/app/items/';

	            // create the folder if it doesn't exist
	            if (!file_exists($item_path)) {
	                mkdir($item_path, 777, true);
	            } 

	            $path = base_path() . '/samplepics/items/' . $imgVal[$i] . '.jpg';  
	            $img = InterImage::make($path); 
	            $filename = time() . '__' . $imgVal[$i] . '.jpg';

	            // create the image in storage item folder
	            $img->save($item_path . $filename, 90);

	            // save filename and mime in item
	            $item->update([
	                'filename'=>$filename,
	                'mimetype'=>'image/jpeg',
	            ]);
 			}  
	    });
    }
}
