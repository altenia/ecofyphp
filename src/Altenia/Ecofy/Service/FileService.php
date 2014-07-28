<?php namespace Altenia\Ecofy\Service;


/**
 * Service class that provides business logic for category
 */
class FileService extends BaseService {

	const ROOT_FOLDER =  'uploads/';

    /**
     * Constructor
     */
    public function __construct($name = 'file')
    {
        parent::__construct($name);
    }

	/**
	 * @param $model    {Mode}   The model object that contains the file parameter
	 * @param $filePropNames {array} The array of property names that are file
	 * 
	 * @return Returns a assoc-array: [{ name, type, size, location, description}] 
	 */
	public function saveUploads($filePropNames, &$model, $subFolder = "")
	{
		if (!empty($subFolder) && !ends_with($subFolder, "/")) {
			$subFolder .= "/";
		}

		$fileInfos = array();


		foreach ($filePropNames as $filePropName) 
		{
			$uploadedFile = \Input::file($filePropName);

			if (!empty($uploadedFile)) 
			{
				$subPath = self::ROOT_FOLDER . $model->getTable() . '/' . $subFolder;
				// @todo - Change public_path() to base_path() once MediaController is implemented
				$uploadRootPath = public_path();
				$destinationPath =  $uploadRootPath . '/' . $subPath;

				self::createDir($destinationPath);

				$filename = $model->sid . '_' . $uploadedFile->getClientOriginalName();
				$extension = $uploadedFile->getClientOriginalExtension();
				$size = $uploadedFile->getSize();;
				$type = $uploadedFile->getMimeType();;

				//self::deleteFile($uploadRootPath . $model->$filePropName);
				// Will be set to something like: 'users/1_myprofile.jpg'
				//$model->$filePropName = $subPath . $filename;

				print_r($destinationPath . ' : ' . $filename);
				$uploadSuccess = $uploadedFile->move($destinationPath, $filename);

				if ($uploadSuccess) {
					$fileInfos[] = array(
							'name' => $uploadedFile->getClientOriginalName(), 
							'type' => $type, 'size' => $size,
							'uri' =>  $subPath . $filename
						);
				}
			}
			//die();
		}

		return $fileInfos;
	}

	public static function createDir($dir)
	{
		if (!file_exists($dir))
		{
			mkdir($dir, 0777, true);
		}
	}

	public static function deleteFile($path)
	{
		if (!file_exists($path))
		{
			return unlink($dir);
		}
		return false;
	}
}