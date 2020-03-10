<?

$tips = array();
$tips[] = array('title' => 'Pe³ny podgl±d wyników', 'content' => 'Mo¿esz obejrzeæ pe³ny podgl±d wyników u¿ytkownika - wraz z odpowiedziami jakich udzieli³ przy ka¿dym pytaniu. Wystarczy ¿e w panelu "Wyniki", przy wybranym wyniku u¿yjesz opcji "Pe³ny podgl±d" (opcja dostepna tylko dla administratorow).');
$tips[] = array('title' => 'Zabezpieczenie przed oszukiwaniem', 'content' => 'Istnieje mozliwosc, aby utrudnic uczniom sciaganie podczas testu. W tym celu, przy tworzeniu nowego testu, aktywuj system zapobiegajacy sciaganiu.');
$tips[] = array('title' => 'Zabezpieczenie przed kilku krotnym wypelnianiem', 'content' => 'Aby zabezpieczyc test przed kilku krotnym wypelnianiem go (dotyczy to tylko konta gosc), przy tworzeniu nowego testu, aktywuj opcje "blokuj test na 5 minut po wypelnieniu".');
$tips[] = array('title' => 'Dostosowywanie systemu oceniania', 'content' => 'Mozesz dostosowac system oceniania w systemie, do tego w Twojej szkole. W tym celu uzyj opcji Edytuj w panelu System oceniania.');

$tip = $tips[rand(0,count($tips)-1)];

$subTpl = new bTemplate();
$subTpl->set('tip',$tip);
echo $subTpl->fetch('template/admin/main.tpl');

?>
