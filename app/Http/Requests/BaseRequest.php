<?php
namespace App\Http\Requests;

use App\Core\Support\Pagination;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseRequest extends FormRequest
{
    abstract public function authorize(): bool;
    abstract public function rules(): array;
    protected $stopOnFirstFailure = false;

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
    protected function failedValidation(Validator $validator): Response
    {
        $errors = collect($validator->errors()->toArray())
            ->map(fn (array $error): string => count($error) === 0 ? '' : $error[0]);
        $details = [
            'rules' => $this->mappedRules(),
            'error' => $validator->getMessageBag()
        ];
        throw new HttpResponseException(
            response()->json([
                'data' => $this->getErrorsArray($errors),
                'message' => 'Informe os dados corretamente.',
                'details' => $details
            ], Response::HTTP_BAD_REQUEST, [
            ])
        );
    }
    private function getErrorsArray(Collection $errors): array
    {
        $errorsArray = [];
        foreach ($errors as $key => $error) :
            $matches = [];
            if (preg_match('/(\w+)\.(\d)+/', $key, $matches)) :
                $newKey = $matches[1] . "[" . $matches[2] . "]";
                $errorsArray[$newKey] = $error;
            else :
                $errorsArray[$key] = $error;
            endif;
        endforeach;
        return $errorsArray;
    }
    private function mappedRules()
    {
        return collect($this->rules())->map(function ($rule) {
            if (gettype($rule) !== 'array') :
                return explode('|', $rule);
            endif;
            foreach ($rule as $i => $subRule) :
                if (gettype($subRule) === 'object') :
                    $rule[$i] = get_class($subRule);
                endif;
            endforeach;
            return $rule;
        });
    }
}
