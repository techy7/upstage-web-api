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
        factory(App\Listing::class, 30)->create()->each(function ($list) use($faker) { 
 			$numOfItems = rand(3,9);

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

	            $value = rand(1,10);   
	            $path = base_path() . '/samplepics/items/' . $value . '.jpg';  
	            $img = InterImage::make($path); 
	            $filename = time() . '__' . $value . '.jpg';
	            
	            // resize the image to 1000px width
	            $img->resize(1000, null, function ($constraint) {
					$constraint->aspectRatio();
				});

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
