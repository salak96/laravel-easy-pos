<?php

namespace App\Livewire;

use Livewire\Component;

class Error extends Component
{
    public $error;

    // Jadikan parameter opsional
    public function mount($error = null)
    {
        $this->error = $error;
    }

    public function render()
    {
        return view('livewire.error');
    }
}
