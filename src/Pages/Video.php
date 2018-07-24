<?php

namespace Dynamic\HTML5Video\Pages;

use Page;

use SilverStripe\Assets\File;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\TextField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\View\Requirements;
use PageController;


/**
 * Class Video
 * @package Dynamic\HTML5Video\Pages
 */
class Video extends Page
{
	/**
	 * @var array
	 */
	private static $db = [
		'Time' => 'Varchar(100)',
	];

	/**
	 * @var array
	 */
	private static $has_one = [
		'MP4Video' => File::class,
		'OggVideo' => File::class,
		'WebMVideo' => File::class,
		'Image' => Image::class,
	];

	/**
	 * @var string
	 */
	private static $singular_name = 'HTML5 Video';

	/**
	 * @var string
	 */
	private static $plural_name = 'HTML5 Vidoes';

	/**
	 * @var string
	 */
	private static $description = 'Single Video Detail Page';

	/**
	 * @var string
	 */
	private static $table_name = 'Video';

	/**
	 * Sets the ShowInMenus field to false.
	 */
	public function populateDefaults()
	{
		$this->ShowInMenus = 0;
		parent::populateDefaults();
	}

	/**
	 * @return \SilverStripe\Forms\FieldList
	 */
	public function getCMSFields()
	{
		$fields = parent::getCMSFields();

		$fields->dataFieldByName('Title')->setTitle('Video Title');
		if ($content = $fields->dataFieldByName('Content')) {
			$content->setTitle('Video Description');
		}

		$fields->insertBefore(
			TextField::create('Time', 'Video Duration')
				->setDescription('ex. mm:ss'),
			'Content'
		);

		// poster
		$PosterField = UploadField::create(Image::class, 'Poster Image')
			->setFolderName('Uploads/Video/Images')
			->setAllowedMaxFileNumber(1)
			->setAllowedExtensions([
				'jpg',
				'jpeg',
				'gif',
				'png'
			])
			->setDescription('Preview image for the video.');
		$PosterField->getValidator()->setAllowedMaxFileSize(VIDEO_IMAGE_FILE_SIZE_LIMIT);

		$fields->insertBefore(
			$PosterField,
			'Content'
		);

		$MP4Field = new UploadField('MP4Video');
		$MP4Field
			->setTitle('MP4 Video')
			->setFolderName('Uploads/Video/MP4Video')
			->setAllowedMaxFileNumber(1)
			->setDescription('Required. Format compatible with most browsers.')
			->setAllowedExtensions(['mp4', 'm4v']);
		$MP4Field->getValidator()->setAllowedMaxFileSize(VIDEO_FILE_SIZE_LIMIT);

		$OggField = UploadField::create('OggVideo');
		$OggField
			->setTitle('Ogg Video')
			->setFolderName('Uploads/Video/OggVideo')
			->setAllowedMaxFileNumber(1)
			->setDescription('Optional. Format compatible with FireFox.')
			->setAllowedExtensions(['ogv', 'ogg']);
		$OggField->getValidator()->setAllowedMaxFileSize(VIDEO_FILE_SIZE_LIMIT);

		$WebMField = UploadField::create('WebMVideo');
		$WebMField
			->setTitle('WebM Video')
			->setFolderName('Uploads/Video/WebMVideo')
			->setAllowedMaxFileNumber(1)
			->setDescription('Optional. Format compatible with Chrome.')
			->setAllowedExtensions(['webm']);
		$WebMField->getValidator()->setAllowedMaxFileSize(VIDEO_FILE_SIZE_LIMIT);

		$fields->addFieldsToTab('Root.Video', [
			$MP4Field,
			$WebMField,
			$OggField,
		]);

		return $fields;
	}

	/**
	 * This function allows the validation of record data
	 * on Save.
	 *
	 * @return RequiredFields
	 */
	public function getCMSValidator()
	{
		return new RequiredFields(['MP4Video']);
	}

	/**
	 * @return bool
	 */
	public function getRelatedVideos()
	{
		if ($this->Parent() && $this->Parent()->ClassName == VideoGroup::class) {
			return $this->Parent()->getVideoList()->exclude('ID', $this->ID);
		}

		return false;
	}
}
