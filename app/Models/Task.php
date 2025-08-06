<?php

namespace App\Models;

use App\Enums\Quadrant;
use App\Enums\TaskType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'description',
        'quadrant',
        'notes',
        'completed_at',
        'start_at',
        'end_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'type' => TaskType::class,
        'quadrant' => Quadrant::class,
    ];

    public function quadrant()
    {
        return $this->belongsTo(Quadrant::class);
    }

    public function type()
    {
        return $this->belongsTo(TaskType::class);
    }   

    public function isCompleted()
    {
        return $this->completed_at !== null;
    }

    public function isScheduled()
    {
        return $this->start_at !== null && $this->end_at !== null;
    }

    public function isUrgentAndImportant()
    {
        return $this->quadrant === Quadrant::UrgentAndImportant;
    }

    public function isNotUrgentButImportant()
    {
        return $this->quadrant === Quadrant::NotUrgentButImportant;
    }

    public function isUrgentButNotImportant()
    {
        return $this->quadrant === Quadrant::UrgentButNotImportant;
    }

    public function isNotUrgentAndNotImportant()
    {
        return $this->quadrant === Quadrant::NotUrgentAndNotImportant;
    }

    public function isCall()    
    {
        return $this->type === TaskType::Call;
    }

    public function isDo()
    {
        return $this->type === TaskType::Do;
    }

    public function isGo()
    {
        return $this->type === TaskType::Go;
    }

    public function typeColor()
    {
        return $this->type->color();
    }

    public function quadrantColor()
    {
        return $this->quadrant->color();
    }

    public function quadrantIcon()
    {
        return $this->quadrant->icon();
    }

    public function quadrantLabel()
    {
        return $this->quadrant->label();
    }

    public function typeLabel()
    {
        return $this->type->label();
    }

    public function typeIcon()
    {
        return $this->type->icon();
    }

    public function quadrantAction()
    {
        return $this->quadrant->action();
    }

    public function scopeWithToday($query)
    {
    return $query->whereDate('created_at', now()->toDateString())
    ->orderByRaw('completed_at is null desc')
    ->orderBy('completed_at', 'asc')
    ->orderBy('start_at', 'desc')
    ->orderBy('type', 'asc');
    }

    public function scopeWithOverdue($query)
    {
        return $query
        ->whereDate('created_at', '<', now()->toDateString())
        ->orderByRaw('completed_at is null desc')
        ->orderBy('completed_at', 'asc')
        ->orderBy('created_at', 'desc')
        ->orderBy('start_at', 'asc');
    }

    public function scopeWithCompleted($query)
    {
        return $query->whereNotNull('completed_at');
    }

    public function isInProgress()
    {
        return $this->isScheduled() && !$this->isCompleted();
    }

    public function isNotInProgress()
    {
        return !$this->isScheduled() || $this->isCompleted();
    }

    public function isOverdue()
    {
        return $this->start_at < now() && !$this->isCompleted();
    }

    public function isDueToday()
    {
        return $this->start_at->isToday() && !$this->isCompleted();
    }

    public function isDueTomorrow()
    {
        return $this->start_at->isTomorrow() && !$this->isCompleted();
    }

    public function status(): string
    {
        return match(true) {
            $this->isCompleted() => 'completed',
            $this->isOverdue() => 'overdue',
            $this->isDueToday() => 'due_today',
            $this->isDueTomorrow() => 'due_tomorrow',
            $this->isInProgress() => 'in_progress',
            $this->isNotInProgress() => 'not_in_progress',
            default => 'pending',
        };
    }
}
