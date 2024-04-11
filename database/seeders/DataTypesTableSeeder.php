<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataType;

class DataTypesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $dataType = $this->dataType('slug', 'users');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'users',
                'display_name_singular' => __('voyager::seeders.data_types.user.singular'),
                'display_name_plural'   => __('voyager::seeders.data_types.user.plural'),
                'icon'                  => 'voyager-person',
                'model_name'            => 'TCG\\Voyager\\Models\\User',
                'policy_name'           => 'TCG\\Voyager\\Policies\\UserPolicy',
                'controller'            => 'TCG\\Voyager\\Http\\Controllers\\VoyagerUserController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'menus');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'menus',
                'display_name_singular' => __('voyager::seeders.data_types.menu.singular'),
                'display_name_plural'   => __('voyager::seeders.data_types.menu.plural'),
                'icon'                  => 'voyager-list',
                'model_name'            => 'TCG\\Voyager\\Models\\Menu',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'roles');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'roles',
                'display_name_singular' => __('voyager::seeders.data_types.role.singular'),
                'display_name_plural'   => __('voyager::seeders.data_types.role.plural'),
                'icon'                  => 'voyager-lock',
                'model_name'            => 'TCG\\Voyager\\Models\\Role',
                'controller'            => 'TCG\\Voyager\\Http\\Controllers\\VoyagerRoleController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }


        
        $dataTypeProducts = $this->dataType('slug', 'products');
        if (!$dataTypeProducts->exists) {
            $dataTypeProducts->fill([
                'name'                  => 'products',
                'display_name_singular' => 'Product',
                'display_name_plural'   => 'Products',
                'icon'                  => 'voyager-bag',
                'model_name'            => 'App\\Models\\Product',
                'controller'            => 'TCG\\Voyager\\Http\\Controllers\\VoyagerBaseController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

      
        // $dataTypeProductImages = $this->dataType('slug', 'product_images');
        // if (!$dataTypeProductImages->exists) {
        //     $dataTypeProductImages->fill([
        //         'name'                  => 'product_images',
        //         'display_name_singular' => 'Product Image',
        //         'display_name_plural'   => 'Product Images',
        //         'icon'                  => 'voyager-photos',
        //         'model_name'            => 'App\\Models\\ProductImage',
        //         'controller'            => 'TCG\\Voyager\\Http\\Controllers\\VoyagerBaseController',
        //         'generate_permissions'  => 1,
        //         'description'           => '',
        //     ])->save();
        // }


    }

    /**
     * [dataType description].
     *
     * @param [type] $field [description]
     * @param [type] $for   [description]
     *
     * @return [type] [description]
     */
    protected function dataType($field, $for)
    {
        return DataType::firstOrNew([$field => $for]);
    }
    /**
     * Add field for multiple images to data type.
     *
     * @param \TCG\Voyager\Models\DataType $dataType
     * @return void
     */
    protected function addMultipleImagesFieldToDataType($dataType)
    {
        $dataType->fields()->create([
            'name'        => 'images',
            'display_name'=> 'Images',
            'type'        => 'multiple_images',
            'required'    => false,
            'browse'      => true,
            'read'        => true,
            'edit'        => true,
            'add'         => true,
            'delete'      => true,
            'details'     => [
                'validation' => [
                    'max'    => 5, 
                ],
            ],
            'order'       => 6, 
        ]);
    }

}
