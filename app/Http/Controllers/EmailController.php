<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Student;
use App\Models\StudentCourse;
use App\Mail\MyEmail;
use App\Models\Course;

class EmailController extends Controller
{
    public function sendEmails($courseId)
{
    // Récupérer le cours spécifique
    $course = Course::findOrFail($courseId);

    // Récupérer tous les enregistrements de la table Student_courses liés à ce cours
    $studentCourses = StudentCourse::where('course_id', $course->id)->get();

    // Parcourir chaque enregistrement de Student_courses
    foreach ($studentCourses as $studentCourse) {
        // Récupérer l'étudiant associé à ce cours
        $student = Student::find($studentCourse->student_id);

        // Vérifier si l'étudiant existe
        if ($student) {
            // Générer un lien unique pour chaque étudiant
            $link = 'exampwd.test/formulaire/' . $studentCourse->token;

            // Envoyer l'e-mail à l'étudiant
            Mail::to($student->email)->send(new MyEmail($studentCourse->token, $link, $course->name));
        }
    }

    return response()->json(['message' => 'E-mails envoyés avec succès pour le cours '.$course->name]);
}


}
