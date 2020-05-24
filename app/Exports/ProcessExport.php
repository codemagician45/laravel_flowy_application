<?php

namespace App\Exports;

use App\User;
use App\Model\Phases;
use App\Model\Themes;
use App\Model\Processes;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Symfony\Component\Process\Process;

class ProcessExport implements FromQuery,WithMapping, WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct(int $id)
    {
        $this->id = $id;
    }
    public function query()
    {
        // return Processes::query()->where('id', $this->id);
        return Processes::query()->where('processes.id',$this->id)->leftJoin('themes','processes.theme_id', '=', 'themes.id')->leftJoin('phases','processes.fase_id', '=', 'phases.id')->leftJoin('users','processes.user_make_changed', '=', 'users.id')->select('processes.id as id','processes.name as name','processes.description as des','processes.sysnum as sysnum','themes.name as tname','phases.name as fname','processes.flowchart as flowchart','processes.long_des as long_des','processes.commit as commit','users.name as uname','processes.created_at as created_at','processes.updated_at as updated_at');
    }

    public function headings(): array
    {
        return [
            'No',
            'Name',
            'Description',
            'SystemNum',
            'Parent Theme',
            'Parent Fase',
            'Flowchart Data',
            'Editor',
            'Commit',
            'User who changed',
            'Created',
            'Last Updated'
        ];
    }
    public function map($processes): array
    {
        return [
            $processes->id,
            $processes->name,
            $processes->des,
            $processes->sysnum,
            $processes->tname,
            $processes->fname,
            $processes->flowchart,
            $processes->long_des,
            $processes->commit,
            $processes->uname,
            $processes->created_at->format('d-m-Y H:i'),
            $processes->updated_at->format('d-m-Y H:i')
        ];
    }
}
