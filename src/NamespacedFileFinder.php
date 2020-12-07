<?php
namespace Germania\NamespacedFileFinder;

class NamespacedFileFinder
{

    /**
     * @var string
     */
    public $default_dir;

    /**
     * @var array
     */
    public $custom_directories;


    /**
     * @param string $default_dir Default directory
     * @param string $custom_dir  Custom directory
     */
    public function __construct(string $default_dir, array $custom_directories = array())
    {
        $this->default_dir = $default_dir;
        $this->custom_directories = $custom_directories;
    }



    /**
     * @param  string $search_file The file to look for
     * @return string
     *
     * @throws \RuntimeException when file does not exist or not is readable
     */
    public function __invoke(string $search_file) : string
    {
        $search_dir = $this->default_dir;

        foreach ($this->custom_directories as $prefix => $custom_dir) {
            $prefix .= $this->stringEndsWith(DIRECTORY_SEPARATOR, $prefix)
                     ? DIRECTORY_SEPARATOR : "";

            if ($this->stringBeginsWith($prefix, $search_file)) {
                $search_dir = $custom_dir;
                $search_file = substr($search_file, strlen($prefix));
            }

        }

        $found_file = join(DIRECTORY_SEPARATOR, [
            $search_dir,
            $search_file
        ]);

        $this->assertFileIsReadable($found_file);
        return $found_file;
    }


    /**
     * @param  string $file File
     * @return bool
     *
     * @throws \RuntimeException when file does not exist or not is readable
     */
    protected function assertFileIsReadable(string $file) : bool
    {
        if (!is_file($file)) {
            $msg = sprintf("FileFinder: file does not exist: '%s'", $file);
            throw new \RuntimeException($msg);
        }
        elseif (!is_readable($file)) {
            $msg = sprintf("FileFinder: file existing, but not readable: '%s'", $file);
            throw new \RuntimeException($msg);
        }

        return true;
    }


    protected function stringBeginsWith($needle, $haystack) : bool
    {
        return (substr($haystack, 0, strlen($needle)) === $needle);
    }

    protected function stringEndsWith( $haystack, $needle ) : bool {
        $length = strlen( $needle );
        if( !$length ) {
            return true;
        }
        return substr( $haystack, -$length ) === $needle;
    }
}
