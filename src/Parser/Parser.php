<?php

namespace Reporter\Parser;

/**
 * Interface Parser
 */
interface Parser
{
    /**
     * @param $fileName
     * @return mixed
     */
    public function openFile($fileName);

    /**
     * @param $file
     * @return mixed
     */
    public function parseFile($file);

    /**
     * @param $file
     */
    public function closeFile($file): void;
}