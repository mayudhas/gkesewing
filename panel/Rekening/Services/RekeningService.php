<?php

namespace Panel\Rekening\Services;

use App\Models\AkunModel;

class RekeningService
{

    public function __construct(public AkunModel $akunModel)
    {
    }

    public final function fetch(): array
    {
        return $this->akunModel->findAll();
    }

    public final function findAccountPost(int $postID): array
    {
        return $this->akunModel->where(['uti_account_post_id' => $postID])->findAll();
    }


}