<?php

namespace App\Enums;

use Illuminate\Validation\Rules\Password;

enum ValidatorEnum: string
{
    public static function PASSWORD_RULE(): array
    {
        return [
            'required', 'string', 'min:6', 'confirmed',
            //Password::min(8)->mixedCase()
        ];
    }

    case IMAGE = "image|mimes:jpeg,png,jpg,gif,svg|max:20480";
    case DOCUMENT = "file|mimes:ppt,pptx,doc,docx,pdf,xls,xlsx|max:204800";
}
