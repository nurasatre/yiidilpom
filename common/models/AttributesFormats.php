<?php


namespace common\models;


trait AttributesFormats {

	public function getTrimContent( $value, $source ): string {
		return htmlspecialchars( mb_substr( $value, 0, 70 ) . ' ...' );
	}

	public function getAuthorName( $value, $source ): ?string {
		$id = (int) $value;

		$error_message = 'User undefined';

		if ( ! $id ) {
			return $error_message;
		}
		$user = User::findOne( $id );

		return $user ? $user->username : $error_message;
	}

	public function getAttachmentName( $value, $source ): ?string {
		if ( ! $value ) {
			return '';
		}
		$file = Files::findOne( (int) $value );

		return $file ? $file->title : '';
	}

	public function getCreatedDate( $value, $source ): string {
		return date( 'F j, Y, g:i a', strtotime( $value ) );
	}

}