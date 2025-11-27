<?php

namespace App\Services;

use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerSearchService
{
    public function search(Request $request)
    {
        $query = Worker::query();

        if ($request->search) {
            //убираю все опасные символы, оставляю только буквы, цифры и пробелы
            $search = preg_replace('/[^a-zA-Z0-9\s]/u', ' ', $request->search);

            // Убираю несколько пробелов подряд
            $search = trim(preg_replace('/\s+/', ' ', $search));

            //если после очистки ничего не осталось - то запрос не делаем
            if (!empty($search)) {
                $words = explode(' ', $search);
                //каждому слову в поиске приделай символ * для формирования запроса по типу vlad* mail* ru*
                $words = array_map(fn($word) => $word . '*', $words);
                $search = implode(' ', $words);

                $query->whereRaw(
                    "MATCH(name, surname, phone, email, description)
                        AGAINST(? IN BOOLEAN MODE)",
                    [$search]
                );
            }
        }
        //dump($query); посмотреть что в запросе
        return $query->paginate(6)->withQueryString();
    }
}
