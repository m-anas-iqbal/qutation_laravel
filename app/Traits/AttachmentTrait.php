<?php

namespace App\Traits;

use App\Attachment;
use Str;

trait AttachmentTrait {

	public function addAttachment($file, $path = '')
	{
		$extension = $file->getClientOriginalExtension();
		$filename = time() . Str::random(6) . '.' . $extension;
		$file->move('public/uploads', $filename);

		$attachment = Attachment::create([
	        'attachment' => $filename
		]);

		if (!empty($path)) {
			return array(
				'attachment_id' => $attachment->id,
				'attachment' => $filename,
			);
		}

		return $attachment->id;
	}

	public function removeAttachment($id)
	{
		if ($id != '') {
			$attachment = Attachment::find($id);

			if (file_exists('public/uploads/' . $attachment->attachment))
				unlink(('public/uploads/' . $attachment->attachment));
			$attachment->delete();
		}

		return true;
	}

}
