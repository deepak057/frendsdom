<?php
/**
 * @var HOAuthWidget $this
 * @var string $provider name of provider
 */

$additionalClass = $this->onlyIcons ? 'icon' : '';
$invitation = Yii::app()->user->isGuest ? HOAuthAction::t('Sign in with') : HOAuthAction::t('Connect with');
?>
<p>
    <a href="<?php echo Yii::app()->createAbsoluteUrl('/Oauth/oauth', array('provider' => $provider)); ?>" class="zocial <?= $additionalClass . ' ' . strtolower($provider) ?>"><?= "$invitation $provider"; ?></a>
</p>
