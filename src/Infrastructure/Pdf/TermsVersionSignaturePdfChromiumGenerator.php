<?php

declare(strict_types=1);

namespace RichId\TermsModuleChromiumBundle\Infrastructure\Pdf;

use HeadlessChromium\BrowserFactory;
use RichId\TermsModuleBundle\Domain\Entity\TermsUserInterface;
use RichId\TermsModuleBundle\Domain\Entity\TermsVersionSignature;
use RichId\TermsModuleBundle\Domain\Pdf\TermsVersionSignaturePdfGeneratorInterface;
use RichId\TermsModuleChromiumBundle\Infrastructure\DependencyInjection\Configuration;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Twig\Environment;

class TermsVersionSignaturePdfChromiumGenerator implements TermsVersionSignaturePdfGeneratorInterface
{
    /** @var Environment */
    protected $twig;

    /** @var ParameterBagInterface */
    protected $parameterBag;

    public function __construct(Environment $twig, ParameterBagInterface $parameterBag)
    {
        $this->twig = $twig;
        $this->parameterBag = $parameterBag;
    }

    public function __invoke(TermsVersionSignature $termsVersionSignature, ?TermsUserInterface $editor = null): string
    {
        $content = $this->twig->render(
            '@RichIdTermsModule/admin/signature-list/_partial/_pdf.html.twig',
            [
                'signature' => $termsVersionSignature,
                'editor'    => $editor,
            ]
        );

        $browserFactory = new BrowserFactory(Configuration::get('chrome_binary', $this->parameterBag));
        $browser = $browserFactory->createBrowser(['customFlags' => Configuration::get('chrome_custom_flags', $this->parameterBag)]);

        try {
            $page = $browser->createPage();
            $page->setHtml($content, 10000);
            $page->waitUntilContainsElement('#pdf-fonts-loaded');
            $pdf = \base64_decode(
                $page->pdf(
                    [
                        'printBackground'     => true,
                        'preferCSSPageSize'   => true,
                        'displayHeaderFooter' => true,
                        'footerTemplate'      => $this->twig->render('@RichIdTermsModule/admin/signature-list/_partial/_pdf-footer.html.twig'),
                        'headerTemplate'      => '<div></div>',
                    ]
                )
                    ->getBase64()
            );

            $browser->close();

            return $pdf;
        } catch (\Throwable $e) {
            throw new \Exception('An error occured on pdf generation.');
        } finally {
            $browser->close();
        }
    }
}
