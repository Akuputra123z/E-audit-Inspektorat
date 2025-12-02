<?php

namespace App\Http\Controllers;
use App\Models\Lhp;
use Barryvdh\DomPDF\Facade\Pdf;


use Illuminate\Http\Request;

class RecommendationsPdfController extends Controller
{
    public function generate($lhp_id)
    {
        $lhp = Lhp::with([
            'unit',
            'recommendations.kodeRekomendasi',
            'recommendations.kodeTemuan'
        ])->findOrFail($lhp_id);

        // Replace karakter yang tidak boleh
        $safeFilename = preg_replace('/[\/\\\\]/', '-', $lhp->nomor_lhp);

        $pdf = Pdf::loadView('pdf.recommendations', [
            'lhp' => $lhp
        ])->setPaper('a4', 'portrait');

        return $pdf->download('LHP-' . $safeFilename . '.pdf');
    }
}
