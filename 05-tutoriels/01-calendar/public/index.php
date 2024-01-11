<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/calendar.css">
    <title>Calendrier</title>
</head>
<body>

   <nav class="navbar navbar-dark bg-primary mb-3">
       <a href="" class="navbar-brand">Mon calendrier</a>
   </nav>

   <!-- example: Mars 2018 -->
   <?php
   require '../src/Date/Month.php';

   $month   = new \App\Date\Month($_GET['month'] ?? null, $_GET['year'] ?? null);
   $fistDay = $month->getFirstDayOfMonth()->modify('last monday');
   ?>

   <div class="d-flex flex-row align-items-center justify-content-between mx-sm-3">
        <h1><?= $month->toString() ?></h1>
        <div>
            <a href="<?= $month->previousMonthLink() ?>" class="btn btn-primary">&lt;</a>
            <a href="<?= $month->nextMonthLink() ?>" class="btn btn-primary">&gt;</a>
        </div>
   </div>

   <table class="calendar__table calendar__table--<?= $month->getWeeks(); ?>weeks">
      <?php for ($i = 0; $i < $month->getWeeks(); $i++): ?>
         <tr>
             <?php
             foreach ($month->days as $k => $day):
             $date = (clone $fistDay)->modify("+" . ($k + $i * 7) . " days");
             ?>
             <td class="<?= $month->withInMonth($date) ? '' : 'calendar__othermonth'?>">
                 <?php if ($i === 0): ?>
                     <div class="calendar__weekday"><?= $day ?></div>
                 <?php endif; ?>
                 <div class="calendar__day"><?= $date->format('d'); ?></div>
             </td>
             <?php endforeach; ?>
         </tr>
      <?php endfor; ?>
   </table>

</body>
</html>

