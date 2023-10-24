<?php
namespace App\Http\Requests;

use App\Helpers\Pagination\Pagination;
use Illuminate\Foundation\Http\FormRequest;

abstract class BaseRequest extends FormRequest
{
    public function hasPagination(): bool
    {
        return $this->page && $this->perPage;
    }
    public function getPagination(): ?Pagination
    {
        $page = (int)$this->page;
        $perPage = (int)$this->perPage;
        if (!$this->hasPagination()) :
            return null;
        endif;
        if ($page < 0) :
            return null;
        endif;
        if ($perPage < 0) :
            return null;
        endif;
        return Pagination::builder()
            ->setCurrentPage($page)
            ->setPerPage($perPage);
    }
}
